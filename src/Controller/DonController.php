<?php

namespace App\Controller;

use App\Entity\Don;
use App\Entity\Donor;
use App\Form\DonateType;
use App\Form\DonorType;
use App\Repository\DonRepository;
use App\Service\Mailer;
use App\Service\Reciept;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/don")
 */
class DonController extends AbstractController
{
    /**
     * @Route("/", name="don_index", methods={"GET"})
     * @param DonRepository $donRepository
     * @return Response
     */
    public function index(DonRepository $donRepository): Response
    {
        return $this->render('don/index.html.twig', [
            'dons' => $donRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="don_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $donor = new Donor();
        $don = new Don();
        $donor->addDon($don);
        $form = $this->createForm(DonorType::class, $donor);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($donor);
                $em->flush();

                return $this->redirectToRoute('don_index');
            }
        }

        return $this->render('don/new.html.twig', [
            'don' => $don,
            'form' => $form->createView(),
        ]);
    }

    /**
     * New don for an existing donor
     * @Route("/existing-donor/new/", name="don_existing_donor")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function newForExistingDonor(Request $request)
    {
        $don = new Don();

        $form = $this->createForm(DonateType::class, $don);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($don);
                $em->flush();
                return $this->redirectToRoute('don_index');
            }
        }

        return $this->render('don/new_don_for_existing.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="don_show", methods={"GET"})
     * @param Don $don
     * @return Response
     */
    public function show(Don $don): Response
    {
        return $this->render('don/show.html.twig', [
            'don' => $don,
        ]);
    }

    /**
     * @Route("/generate-receipt/{don}", name="don_receipt_generate")
     * @param Mailer $cMailer
     * @param Reciept $receipt
     * @param Don $don
     * @return Response
     */
    public function generateReceipt(Mailer $cMailer, Reciept $receipt, Don $don): Response
    {
        $this->pdfGeneration($cMailer, $receipt, $don);
        return $this->redirectToRoute('don_receipt_view', ['don' => $don->getId()]);
    }


    /**
     * @Route("/generate-bulk-receipt", name="don_receipt_generate_bulk", options = { "expose" = true })
     * @param Request $request
     * @param Mailer $cMailer
     * @param DonRepository $donRepository
     * @param Reciept $receipt
     * @return Response
     */
    public function generateBulkReceipt(
        Request $request,
        Mailer $cMailer,
        DonRepository $donRepository,
        Reciept $receipt
    ): Response {
        $data = ['status' => true, 'message' => ''];
        try {
            $dons = $request->request->get('dons');
            foreach ($dons as $id) {
                $don = $donRepository->find($id);
                if ($don->getReceiptFile()) {
                    $receipt->deleteReceipt($don->getReceiptFile(), 'receipt');
                }
                $this->pdfGeneration($cMailer, $receipt, $don);
            }
            $this->addFlash('success', 'All receipt are generated!');
        } catch (Exception $e) {
            $data = ['status' => false, 'message' => $e->getMessage()];
            $this->addFlash('error', 'Problems in bulk generation');
        }


        return new JsonResponse($data);
    }

    /**
     * @Route("/regenerate-receipt/{don}", name="don_receipt_regenerate")
     * @param Mailer $cMailer
     * @param Reciept $receipt
     * @param Don $don
     * @return Response
     */
    public function regenerateReceipt(Mailer $cMailer, Reciept $receipt, Don $don): Response
    {
        $receipt->deleteReceipt($don->getReceiptFile(), 'receipt');
        return $this->pdfGeneration($cMailer, $receipt, $don);
    }

    /**
     * @Route("/receipt/view/{don}", name="don_receipt_view", methods={"GET"})
     * @param Reciept $receipt
     * @param Don $don
     */
    public function viewReceipt(Reciept $receipt, Don $don)
    {
        $receipt->pdfPreview($don->getReceiptFile(), 'receipt');
    }

    /**
     * @Route("/{id}/edit", name="don_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Don $don
     * @return Response
     */
    public function edit(Request $request, Don $don): Response
    {
        $donor = $don->getDonor();
        $form = $this->createForm(DonorType::class, $donor);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($donor);
                $em->flush();

                return $this->redirectToRoute('don_index');
            }
        }

        return $this->render('don/edit.html.twig', [
            'don' => $don,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="don_delete", methods={"DELETE"})
     * @param Request $request
     * @param Don $don
     * @return Response
     */
    public function delete(Request $request, Don $don): Response
    {
        if ($this->isCsrfTokenValid('delete'.$don->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($don);
            $entityManager->flush();
        }

        return $this->redirectToRoute('don_index');
    }

    /**
     * @param Mailer $mailer
     * @param Reciept $receipt
     * @param Don $don
     * @return BinaryFileResponse
     */
    private function pdfGeneration(Mailer $mailer, Reciept $receipt, Don $don): BinaryFileResponse
    {
        $file = $receipt->generatePdfReceipt($don);
        $fileName = basename($file);
        // This should return the file to the browser as response
        $response = new BinaryFileResponse($file);
        $response->headers->set(
            'Content-Type',
            'application/pdf'
        );
        $don->setReceiptFile($fileName);
        $don->setReceipt(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($don);
        $entityManager->flush();
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $fileName);
        // send the email:
        $mailer->sendReceipt($don);

        return $response;
    }
}

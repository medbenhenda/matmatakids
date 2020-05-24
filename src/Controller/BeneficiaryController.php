<?php

namespace App\Controller;

use App\Entity\Beneficiary;
use App\Form\BeneficiaryType;
use App\Repository\BeneficiaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/beneficiary")
 */
class BeneficiaryController extends AbstractController
{
    /**
     * @Route("/", name="beneficiary_index", methods={"GET"})
     */
    public function index(BeneficiaryRepository $beneficiaryRepository): Response
    {
        return $this->render('beneficiary/index.html.twig', [
            'beneficiaries' => $beneficiaryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="beneficiary_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $beneficiary = new Beneficiary();
        $form = $this->createForm(BeneficiaryType::class, $beneficiary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($beneficiary);
            $entityManager->flush();

            return $this->redirectToRoute('beneficiary_index');
        }

        return $this->render('beneficiary/new.html.twig', [
            'beneficiary' => $beneficiary,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="beneficiary_show", methods={"GET"})
     */
    public function show(Beneficiary $beneficiary): Response
    {
        return $this->render('beneficiary/show.html.twig', [
            'beneficiary' => $beneficiary,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="beneficiary_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Beneficiary $beneficiary): Response
    {
        $form = $this->createForm(BeneficiaryType::class, $beneficiary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('beneficiary_index');
        }

        return $this->render('beneficiary/edit.html.twig', [
            'beneficiary' => $beneficiary,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="beneficiary_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Beneficiary $beneficiary): Response
    {
        if ($this->isCsrfTokenValid('delete'.$beneficiary->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($beneficiary);
            $entityManager->flush();
        }

        return $this->redirectToRoute('beneficiary_index');
    }
}

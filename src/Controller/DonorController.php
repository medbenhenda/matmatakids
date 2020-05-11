<?php

namespace App\Controller;

use App\Entity\Donor;
use App\Form\DonorFormType;
use App\Repository\DonorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/donor")
 */
class DonorController extends AbstractController
{
    /**
     * @Route("/", name="donor_index", methods={"GET"})
     * @param DonorRepository $donorRepository
     * @return Response
     */
    public function index(DonorRepository $donorRepository): Response
    {
        $donors = $donorRepository->findDonors();

        return $this->render('donor/index.html.twig', [
            'donors' => $donors,
            'title' => 'Donor',
        ]);
    }

    /**
     * @Route("/adherents", name="donor_adherents", methods={"GET"})
     * @param DonorRepository $donorRepository
     * @return Response
     */
    public function adherents(DonorRepository $donorRepository): Response
    {
        $donors = $donorRepository->findBy(['isAdherent' => true]);

        return $this->render('donor/adherent.html.twig', [
            'adherents' => $donors,
        ]);
    }

    /**
     * @Route("/new", name="donor_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $donor = new Donor();
        $form = $this->createForm(DonorFormType::class, $donor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($donor);
            $entityManager->flush();

            return $this->redirectToRoute('donor_index');
        }

        return $this->render('donor/new.html.twig', [
            'donor' => $donor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="donor_show", methods={"GET"})
     * @param Donor $donor
     * @return Response
     */
    public function show(Donor $donor): Response
    {
        return $this->render('donor/show.html.twig', [
            'donor' => $donor,
        ]);
    }

    /**
     * @Route("/dons/{id}", name="dons_by_donor", methods={"GET"})
     * @param Donor $donor
     * @return Response
     */
    public function donsByDonor(Donor $donor): Response
    {
        return $this->render('donor/dons_by_donor.html.twig', [
            'donor' => $donor,
            'dons' => $donor->getDons(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="donor_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Donor $donor
     * @return Response
     */
    public function edit(Request $request, Donor $donor): Response
    {
        $form = $this->createForm(DonorFormType::class, $donor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('donor_index');
        }

        return $this->render('donor/edit.html.twig', [
            'donor' => $donor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="donor_delete", methods={"DELETE"})
     * @param Request $request
     * @param Donor $donor
     * @return Response
     */
    public function delete(Request $request, Donor $donor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$donor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($donor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('donor_index');
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity;
use App\Form\DonorType;
use App\Form\DonateType;
use Symfony\Component\HttpFoundation\Request;

class DonController extends AbstractController
{
  /**
     * @var DonorRepository
     */
    private $donorRepository;
    /**
     * @Route("/don", name="don")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Entity\Don::class);
        $dons = $repository->findAll();
        return $this->render('don/index.html.twig', [
            'dons' => $dons,
        ]);
    }

    /**
     * @Route("/don/new", name="new_don")
     */
    public function new(Request $request)
    {
        $donor = new Entity\Donor();
        $don = new Entity\Don();
        $donor->addDon($don);
        $form = $this->createForm(DonorType::class, $donor);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($donor);
                $em->flush();

                return $this->redirectToRoute('donors');
            }
        }


        return $this->render('don/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/don/create", name="create_don")
     */
    public function createDon(Request $request)
    {
        // creates a task object and initializes some data for this example
        $don = new Entity\Don();

        $form = $this->createForm(DonateType::class, $don);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($don);
                $em->flush();

                return $this->redirectToRoute('new_don');
            }
        }

        return $this->render('don/new_don.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/donors", name="donors")
     */
    public function donors()
    {
        $repository = $this->getDoctrine()->getRepository(Entity\Donor::class);
        $donors = $repository->findAll();

        return $this->render('don/donors.html.twig', [
            'controller_name' => 'DonController',
            'donors' => $donors
        ]);
    }

    /**
     * @Route("/don/stats", name="don_stats")
     */
    public function stats()
    {
        $repository = $this->getDoctrine()->getRepository(Entity\Donor::class);
        $donors = $repository->findAll();

        return $this->render('don/stats.html.twig', [
            'controller_name' => 'DonController',
            'donors' => $donors
        ]);
    }
}

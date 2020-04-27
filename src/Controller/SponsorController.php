<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity;
use App\Form\SponsorFormType;
use App\Form\AffectationType;
use Symfony\Component\HttpFoundation\Request;

class SponsorController extends AbstractController
{

    /**
     * @Route("/sponsor", name="sponsor")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Entity\Sponsor::class);
        $items = $repository->findAll();
        return $this->render('sponsor/index.html.twig', [
            'items' => $items,
        ]);
    }

    /**
     * @Route("/sponsor/new", name="new_sponsor")
     */
    public function new(Request $request)
    {
      $entity = new Entity\Sponsor();

      $form = $this->createForm(SponsorFormType::class, $entity);
      if ($request->isMethod('POST')) {

          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($entity);
            $em->flush();
              return $this->redirectToRoute('sponsor');
          }
      }

      return $this->render('sponsor/new.html.twig', [
          'form' => $form->createView(),
      ]);

    }

    /**
     * @Route("/sponsor/edit/{entity}", name="edit_sponsor")
     */
    public function edit(Request $request, Entity\Sponsor $entity)
    {
      $form = $this->createForm(SponsorFormType::class, $entity);
      if ($request->isMethod('POST')) {

          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($entity);
            $em->flush();
              return $this->redirectToRoute('sponsor');
          }
      }

      return $this->render('sponsor/new.html.twig', [
          'form' => $form->createView(),
      ]);

    }

    /**
     * @Route("/sponsor/show/{entity}", name="show_sponsor")
     */
    public function show(Request $request, Entity\Sponsor $entity)
    {
      return $this->render('sponsor/new.html.twig', [
          'entity' => $entity,
      ]);

    }

    /**
    * @Route("/sponsor/affect/{sponsor}", name="affect_case_sponsor")
    */
    public function affectSponsorToCases(Request $request, Entity\Sponsor $sponsor)
    {
        $affectation = new Entity\Affectation();
        $form = $this->createForm(AffectationType::class, $affectation, ['sponsor' => $sponsor]);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $em = $this->getDoctrine()->getManager();

                $em->persist($sponsor);
                $em->persist($affectation);

                $em->flush();

                return $this->redirectToRoute('sponsor');
            }
        }

        return $this->render('sponsor/affect.html.twig', [
            'sponsor' => $sponsor,
            'form' => $form->createView(),
        ]);

    }
}

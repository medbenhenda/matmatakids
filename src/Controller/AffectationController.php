<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Affectation;

class AffectationController extends AbstractController
{
    /**
     * @Route("/affectation", name="affectation")
     */
    public function index(): Response
    {
        return $this->render('affectaion/index.html.twig', [
            'controller_name' => 'AffectaionController',
        ]);
    }

    /**
     * @Route("/affectation/show/{entity}", name="show_affectation")
     * @param Affectation $entity
     *
     * @return Response
     */
    public function show(Affectation $entity): Response
    {
        return $this->render('affectaion/show.html.twig', [
            'affectation' => $entity,
        ]);
    }

    /**
     * @Route("/affectation/status/{entity}/{status}", name="status_affectation")
     * @param Affectation $entity
     * @param bool        $status
     *
     * @return Response
     */
    public function status(Affectation $entity, bool $status): Response
    {
        $entity->setStatus($status);
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        return $this->redirectToRoute('show_sponsor', ['entity' => $entity->getSponsor()->getId()]);
    }
}

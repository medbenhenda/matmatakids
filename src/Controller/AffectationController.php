<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Affectation;

class AffectationController extends AbstractController
{
    /**
     * @Route("/affectation", name="affectation")
     */
    public function index()
    {
        return $this->render('affectaion/index.html.twig', [
            'controller_name' => 'AffectaionController',
        ]);
    }

    /**
     * @Route("/affectation/show/{entity}", name="show_affectation")
     */
    public function show(Affectation $entity)
    {
        return $this->render('affectaion/show.html.twig', [
            'controller_name' => 'AffectaionController',
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Subvention;
use App\Form\SubventionType;
use App\Repository\SubventionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subvention")
 */
class SubventionController extends AbstractController
{
    /**
     * @Route("/", name="subvention_index", methods={"GET"})
     */
    public function index(SubventionRepository $subventionRepository): Response
    {
        return $this->render('subvention/index.html.twig', [
            'subventions' => $subventionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="subvention_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subvention = new Subvention();
        $form = $this->createForm(SubventionType::class, $subvention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subvention);
            $entityManager->flush();

            return $this->redirectToRoute('subvention_index');
        }

        return $this->render('subvention/new.html.twig', [
            'subvention' => $subvention,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subvention_show", methods={"GET"})
     */
    public function show(Subvention $subvention): Response
    {
        return $this->render('subvention/show.html.twig', [
            'subvention' => $subvention,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subvention_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Subvention $subvention): Response
    {
        $form = $this->createForm(SubventionType::class, $subvention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subvention_index');
        }

        return $this->render('subvention/edit.html.twig', [
            'subvention' => $subvention,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subvention_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Subvention $subvention): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subvention->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subvention);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subvention_index');
    }
}

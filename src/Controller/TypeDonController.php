<?php

namespace App\Controller;

use App\Entity\TypeDon;
use App\Form\TypeDonType;
use App\Repository\TypeDonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/don")
 */
class TypeDonController extends AbstractController
{
    /**
     * @Route("/", name="type_don_index", methods={"GET"})
     * @param TypeDonRepository $typeDonRepository
     * @return Response
     */
    public function index(TypeDonRepository $typeDonRepository): Response
    {
        return $this->render('type_don/index.html.twig', [
            'type_dons' => $typeDonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_don_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $typeDon = new TypeDon();
        $form = $this->createForm(TypeDonType::class, $typeDon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeDon);
            $entityManager->flush();

            return $this->redirectToRoute('type_don_index');
        }

        return $this->render('type_don/new.html.twig', [
            'type_don' => $typeDon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_don_show", methods={"GET"})
     * @param TypeDon $typeDon
     * @return Response
     */
    public function show(TypeDon $typeDon): Response
    {
        return $this->render('type_don/show.html.twig', [
            'type_don' => $typeDon,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_don_edit", methods={"GET","POST"})
     * @param Request $request
     * @param TypeDon $typeDon
     * @return Response
     */
    public function edit(Request $request, TypeDon $typeDon): Response
    {
        $form = $this->createForm(TypeDonType::class, $typeDon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_don_index');
        }

        return $this->render('type_don/edit.html.twig', [
            'type_don' => $typeDon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_don_delete", methods={"DELETE"})
     * @param Request $request
     * @param TypeDon $typeDon
     * @return Response
     */
    public function delete(Request $request, TypeDon $typeDon): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeDon->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeDon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_don_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Expenses;
use App\Form\ExpensesType;
use App\Repository\ExpensesRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/expenses")
 */
class ExpensesController extends AbstractController
{
    /**
     * @Route("/", name="expenses_index", methods={"GET"})
     * @param ExpensesRepository $expensesRepository
     * @return Response
     */
    public function index(ExpensesRepository $expensesRepository): Response
    {
        return $this->render('expenses/index.html.twig', [
            'expenses' => $expensesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="expenses_new", methods={"GET","POST"})
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $expense = new Expenses();
        $form = $this->createForm(ExpensesType::class, $expense);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form['invoice'] as $key => $childForm) {
                $file = $childForm->get('imageFile')->getData();
                if ($file) {
                    $entityDocument = $childForm->getData();
                    $fileName = $fileUploader->upload($file);
                    $entityDocument->setImageName($fileName);
                }
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($expense);
            $entityManager->flush();

            return $this->redirectToRoute('expenses_index');
        }

        return $this->render('expenses/new.html.twig', [
            'expense' => $expense,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="expenses_show", methods={"GET"})
     * @param Expenses $expense
     * @return Response
     */
    public function show(Expenses $expense): Response
    {
        return $this->render('expenses/show.html.twig', [
            'expense' => $expense,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="expenses_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Expenses $expense
     * @return Response
     */
    public function edit(Request $request, Expenses $expense): Response
    {
        $form = $this->createForm(ExpensesType::class, $expense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('expenses_index');
        }

        return $this->render('expenses/edit.html.twig', [
            'expense' => $expense,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="expenses_delete", methods={"DELETE"})
     * @param Request $request
     * @param Expenses $expense
     * @return Response
     */
    public function delete(Request $request, Expenses $expense): Response
    {
        if ($this->isCsrfTokenValid('delete'.$expense->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($expense);
            $entityManager->flush();
        }

        return $this->redirectToRoute('expenses_index');
    }
}

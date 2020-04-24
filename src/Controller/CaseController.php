<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity as Entity;
use App\Form\FolderType;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;
use App\Form\AffectationType;

class CaseController extends AbstractController
{
    /**
    * @Route("/case", name="case")
    */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Entity\Folder::class);
        $items = $repository->findAll();

        return $this->render('case/index.html.twig', [
            'items' => $items
        ]);
    }

    /**
    * @Route("/case/new", name="new_case")
    */
    public function new(Request $request, FileUploader $fileUploader)
    {
        $case = new Entity\Folder();

        $case->setAffected(0);
        $case->setStatus(0);
        $form = $this->createForm(FolderType::class, $case);
        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                /** @var UploadedFile $brochureFile */

                foreach ($form['proof'] as $key => $childForm) {
                    $file = $childForm->get('imageFile')->getData();
                    if ($file) {
                        $entityDocument = $childForm->getData();

                        $fileName = $fileUploader->upload($file);
                        $entityDocument->setImageName($fileName);
                    }

                }

                $em = $this->getDoctrine()->getManager();

                $em->persist($case);
                $em->flush();

                return $this->redirectToRoute('new_case');
            }
        }

        return $this->render('case/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
    * @Route("/case/edit/{case}", name="edit_case")
    */
    public function edit(Request $request, Entity\Folder $case, FileUploader $fileUploader)
    {
        $form = $this->createForm(FolderType::class, $case);
        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                /** @var UploadedFile $brochureFile */

                foreach ($form['proof'] as $key => $childForm) {
                    $file = $childForm->get('imageFile')->getData();
                    if ($file) {
                        $entityDocument = $childForm->getData();

                        $fileName = $fileUploader->upload($file);
                        $entityDocument->setImageName($fileName);
                    }

                }

                $em = $this->getDoctrine()->getManager();

                $em->persist($case);
                $em->flush();

                return $this->redirectToRoute('case');
            }
        }

        return $this->render('case/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
    * @Route("/case/show/{case}", name="show_case")
    */
    public function show(Request $request, Entity\Folder $case)
    {
        $repository = $this->getDoctrine()->getRepository(Entity\Folder::class);

        return $this->render('case/show.html.twig', [
            'item' => $case,
        ]);
    }

    /**
    * @Route("/case/affect/{case}", name="affect_sponsor_case")
    */
    public function affectCaseToSponsor(Request $request, Entity\Folder $case)
    {
        $affectation = new Entity\Affectation();
        $form = $this->createForm(AffectationType::class, $affectation, ['folder' => $case]);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $case->setAffected(true);
                $em = $this->getDoctrine()->getManager();

                $em->persist($case);
                $em->persist($affectation);

                $em->flush();

                return $this->redirectToRoute('case');
            }
        }

        return $this->render('case/affect.html.twig', [
            'case' => $case,
            'form' => $form->createView(),
        ]);

    }
    /**
    * @Route("/case/manage/{case}/{status}", name="manage_case")
    */
    public function manageCase(Request $request, Entity\Folder $case, $status)
    {
        $case->setStatus($status);
        $em = $this->getDoctrine()->getManager();
        $em->persist($case);
        $em->flush();
        return $this->render('case/show.html.twig', [
            'item' => $case,
        ]);

    }

}

<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Subvention;
use App\Form\SubventionType;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use App\Repository\SubventionRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subvention")
 */
class SubventionController extends AbstractController
{
    /**
     * @Route("/", name="subvention_index", methods={"GET"})
     * @param SubventionRepository $subventionRepository
     * @return Response
     */
    public function index(SubventionRepository $subventionRepository): Response
    {
        return $this->render('subvention/index.html.twig', [
            'subventions' => $subventionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="subvention_new", methods={"GET","POST"})
     * @param Request $request
     * @param FileUploader $fileUploader
     * @param KernelInterface $appKernel
     * @return Response
     */
    public function new(Request $request, FileUploader $fileUploader, KernelInterface $appKernel): Response
    {
        $subvention = new Subvention();
        $form = $this->createForm(SubventionType::class, $subvention);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Form $entreprise */
            $entreprise = strtolower($form['entreprise']->getData());
            foreach ($form['documents'] as $key => $childForm) {
                $file = $childForm->get('imageFile')->getData();
                if ($file) {
                    $destination = $appKernel->getProjectDir().'/public/subventions/'.$entreprise;
                    /** @var Document $entityDocument */
                    $entityDocument = $childForm->getData();
                    $fileName = $fileUploader->upload($file, $destination);
                    $entityDocument->setImageName($fileName);
                    $publicPath = 'subventions/'.$entreprise.'/'.$fileName;
                    $entityDocument->setPath($publicPath);
                }
            }
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
     * @param Subvention $subvention
     * @return Response
     */
    public function show(Subvention $subvention): Response
    {
        return $this->render('subvention/show.html.twig', [
            'subvention' => $subvention,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subvention_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Subvention $subvention
     * @param FileUploader $fileUploader
     * @param KernelInterface $appKernel
     * @return Response
     */
    public function edit(Request $request, Subvention $subvention, FileUploader $fileUploader, KernelInterface $appKernel): Response
    {
        $form = $this->createForm(SubventionType::class, $subvention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entreprise = strtolower($form->get('entreprise')->getData());
            foreach ($form['documents'] as $key => $childForm) {
                $files = $childForm->get('imageFile')->getData();
                if ($files) {
                    $destination = $appKernel->getProjectDir().'/public/subventions/'.$entreprise;
                    $entityDocument = $childForm->getData();

                    foreach ($files as $file) {
                        $fileName = $fileUploader->upload($file, $destination);
                        $entityDocument->setImageName($fileName);
                        $publicPath = 'subventions/'.$entreprise.'/'.$fileName;
                        $entityDocument->setPath($publicPath);

                        $subvention->addDocument($entityDocument);
                    }


                }
            }
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
     * @param Request $request
     * @param Subvention $subvention
     * @param KernelInterface $appKernel
     * @return Response
     */
    public function delete(Request $request, Subvention $subvention, KernelInterface $appKernel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subvention->getId(), $request->request->get('_token'))) {
            if (!$subvention->getDocuments()->isEmpty()) {
                $filesystem = new Filesystem();
                $path = $appKernel->getProjectDir().'/public/subventions/'.strtolower($subvention->getEntreprise());

                if ($filesystem->exists($path)) {
                    $filesystem->remove([$path]);
                }
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subvention);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subvention_index');
    }
}

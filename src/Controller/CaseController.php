<?php

namespace App\Controller;

use App\Service\Affectation;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity as Entity;
use App\Form\FolderType;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;
use App\Form\AffectationType;
use App\Form\FolderItemType;

/**
 * Class CaseController
 *
 * @package App\Controller
 */
class CaseController extends AbstractController
{
    /**
     * @Route("/case", name="case")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Entity\Folder::class);
        $items = $repository->findAllWithProof();

        return $this->render('case/index.html.twig', [
            'items' => $items
        ]);
    }

    /**
     * @Route("/case/edit/{case}", name="edit_case", defaults={"case"=null})
     * @param Request            $request
     * @param Entity\Folder|null $case
     * @param FileUploader       $fileUploader
     *
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, ?Entity\Folder $case, FileUploader $fileUploader)
    {

        $action = 'Update';
        if (!$case) {
            $case = new Entity\Folder();
            $action = 'New';
        }
        $form = $this->createForm(FolderType::class, $case);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                /** @var UploadedFile $fileUploader */

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

        return $this->render('case/edit.html.twig', [
            'form' => $form->createView(),
            'case' => $case,
            'action' => 'update'
        ]);
    }

    /**
     * @Route("/case/show/{case}", name="show_case")
     * @param Request       $request
     * @param Entity\Folder $case
     *
     * @param Affectation   $affectation
     *
     * @return Response
     */
    public function show(Request $request, Entity\Folder $case, Affectation $affectation)
    {
        $affectations = $affectation->getAffectationsByFolder($case);
        $months = [
            ['id' => 1, 'name' => 'Janvier'],
            ['id' => 2, 'name' => 'Février'],
            ['id' => 3, 'name' => 'Mars'],
            ['id' => 4, 'name' => 'Avril'],
            ['id' => 5, 'name' => 'Mai'],
            ['id' => 6, 'name' => 'Juin'],
            ['id' => 7, 'name' => 'Juillet'],
            ['id' => 8, 'name' => 'Août'],
            ['id' => 9, 'name' => 'Septembre'],
            ['id' => 10, 'name' => 'Octobre'],
            ['id' => 11, 'name' => 'Novembre'],
            ['id' => 12, 'name' => 'Décembre'],
        ];


        return $this->render('case/show.html.twig', [
            'item' => $case,
            'affectations' => $affectations,
            'months' => $months,
            'years' => self::getYears()
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

    /**
     * @Route("/case/item/{case}/{item}", name="case_item", defaults={"item"=null})
     */
    public function newItem(Request $request, ?Entity\Folder $case, ?Entity\FolderItem $item)
    {
        $action = 'Update';
        if (!$item) {
            $item = new Entity\FolderItem();
            $action = 'New';
        }
        $form = $this->createForm(FolderItemType::class, $item, ['folder' => $case]);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($item);
                $em->flush();

                return $this->redirectToRoute('show_case', ['case' => $case->getId()]);
            }
        }

        return $this->render('case/new_item.html.twig', [
            'form' => $form->createView(),
            'action' => $action,
            'case' => $case,
        ]);
    }

    /**
     * @return array
     * @throws Exception
     */
    private static function getYears(): array
    {
        $years = [];
        $begin = new DateTime();
        $begin = $begin->modify('-1 year');
        $end = new DateTime();
        $end = $end->modify('+5 year');
        $interval = new DateInterval('P1Y');
        $daterange = new DatePeriod($begin, $interval, $end);
        foreach ($daterange as $date) {
            $years[$date->format('Y')] = $date->format('Y');
        }

        return $years;
    }
}

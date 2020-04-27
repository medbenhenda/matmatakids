<?php

namespace App\Controller;

use App\Entity\ProposingTransaction;
use App\Entity\Folder;
use App\Entity\Sponsor;
use App\Entity\Affectation as EntityAffectation;
use App\Form\ProposingTransactionType;
use App\Repository\AffectationRepository;
use App\Repository\ProposingTransactionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Exception\LogicException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Affectation;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/proposing/transaction")
 */
class ProposingTransactionController extends AbstractController
{
    /**
     * @Route("/", name="proposing_transaction_index", methods={"GET"})
     * @param ProposingTransactionRepository $proposingTransactionRepository
     *
     * @return Response
     */
    public function index(ProposingTransactionRepository $proposingTransactionRepository): Response
    {
        return $this->render('proposing_transaction/index.html.twig', [
            'proposing_transactions' => $proposingTransactionRepository->findAll(),
            'folder' => ''
        ]);
    }

    /**
     * @Route("/new/{affectation}", name="proposing_transaction_new", methods={"GET","POST"})
     * @param Request     $request
     *
     *
     * @param Affectation $affectation
     *
     * @return Response
     * @throws LogicException
     */
    public function new(Request $request, EntityAffectation $affectation): Response
    {
        $proposingTransaction = new ProposingTransaction();
        $form = $this->createForm(ProposingTransactionType::class, $proposingTransaction, [
            'affectation' => $affectation
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($proposingTransaction);
            $entityManager->flush();

            return $this->redirectToRoute('proposing_transaction_index');
        }

        return $this->render('proposing_transaction/new.html.twig', [
            'proposing_transaction' => $proposingTransaction,
            'form' => $form->createView(),
            'affectation' => $affectation,
        ]);
    }

    /**
     * @Route("/save", name="proposing_transaction_save", methods={"POST"},options = { "expose" = true },)
     * @param Request               $request
     *
     * @param AffectationRepository $affectationRepository
     *
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function ajaxSaveTransaction(Request $request, AffectationRepository $affectationRepository): Response
    {
        $proposingTransaction = new ProposingTransaction();
        $postedData = $request->request->all();

        $affectation = $affectationRepository->find($postedData['affectation']);

        $proposingTransaction->setAffectation($affectation);
        $proposingTransaction->setMonth($postedData['month']);
        $proposingTransaction->setYear($postedData['year']);
        $proposingTransaction->setAmount((float)($postedData['amount']));

       // dump($proposingTransaction->getAffectation());exit;
        /** @var EntityManager $entityManager */
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($proposingTransaction);
        $entityManager->flush();

        $encoders = [new JsonEncoder()];

        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $data = $serializer->normalize($proposingTransaction, null, [AbstractNormalizer::ATTRIBUTES => ['id', 'amount']]);

        return new JsonResponse($data);
    }

    /**
     * @Route("/{id}", name="proposing_transaction_show", methods={"GET"})
     */
    public function show(ProposingTransaction $proposingTransaction): Response
    {
        return $this->render('proposing_transaction/show.html.twig', [
            'proposing_transaction' => $proposingTransaction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="proposing_transaction_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProposingTransaction $proposingTransaction): Response
    {
        $form = $this->createForm(ProposingTransactionType::class, $proposingTransaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proposing_transaction_index');
        }

        return $this->render('proposing_transaction/edit.html.twig', [
            'proposing_transaction' => $proposingTransaction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="proposing_transaction_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProposingTransaction $proposingTransaction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$proposingTransaction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($proposingTransaction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('proposing_transaction_index');
    }
}

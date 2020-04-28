<?php

namespace App\Service;

use App\Entity\Affectation;
use App\Repository\ProposingTransactionRepository;

class ProposingTransaction
{
    private $repository;
    public function __construct(ProposingTransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Affectation        $affectation
     * @param                         $year
     *
     * @return array
     */
    public function getTransactionByYearAndAffectation(Affectation $affectation, $year): array
    {
        $items = $this->repository->findBy(['year' => $year, 'affectation' => $affectation]);
        $monthsDone = [];
        foreach ($items as $item) {
            $monthsDone[$item->getMonth()] = $item;
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!array_key_exists($i, $monthsDone)) {
                $monthsDone[$i] = [];
            }
        }

         return $monthsDone;
    }
}

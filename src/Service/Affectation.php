<?php

namespace App\Service;

use App\Entity\Folder;
use App\Entity\Sponsor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use App\Repository\AffectationRepository;

/**
 * Class Affectation
 *
 * @package App\Service
 */
class Affectation
{
    /**
     * @Var EntityManagerInterface
     */
    protected $em;

    /**
     * @Var Security
     */
    protected $security;

    /**
     * @var AffectationRepository;
     */
    protected $repository;

    /**
     * @param EntityManagerInterface    $em
     * @param Security                  $security
     * @param AffectationRepository     $repository
     */
    public function __construct(EntityManagerInterface $em, Security $security, AffectationRepository $repository)
    {
        $this->em = $em;
        $this->security = $security;
        $this->repository = $repository;
    }

    /**
     * @param Folder  $folder
     *
     * @return mixed
     */
    public function getAffectationsByFolder(Folder $folder)
    {
        $affectations = $this->repository->findBy(['folder' => $folder->getId()]);
        $result = [];
        foreach ($affectations as $affectation) {
            $months = [];
            foreach ($affectation->getProposingTransactions() as $transaction) {
                $months[] = $transaction->getMonth();
            }

            $result[] = [
                'affectation' => $affectation,
                'months' => $months
            ];
        }

        return $result;
    }

    /**
     * @param Folder  $folder
     * @param Sponsor $sponsor
     *
     * @return mixed
     */
    public function getAffectationFolderBysponsor(Folder $folder, Sponsor $sponsor)
    {
        return $this->repository->findOneBy(['folder' => $folder->getId(), 'sponsor' => $sponsor->getId()]);
    }

    /**
     * @param $items
     *
     * @return \Generator
     */
    private function generateTransaction($item)
    {
        yield $item->getMonth();
    }
}

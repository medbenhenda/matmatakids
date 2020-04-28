<?php

namespace App\Repository;

use App\Entity\ProposingTransaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProposingTransaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProposingTransaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProposingTransaction[]    findAll()
 * @method ProposingTransaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProposingTransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProposingTransaction::class);
    }

    /**
     * @param $year
     *
     * @return ProposingTransaction[] Returns an array of ProposingTransaction objects
     */
    public function getTransactionByYeay($year)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.year = :val')
            ->setParameter('val', $year)
            ->groupBy('p.affectation, p.month')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return ProposingTransaction[] Returns an array of ProposingTransaction objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProposingTransaction
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\TypeDon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeDon|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeDon|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeDon[]    findAll()
 * @method TypeDon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeDonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeDon::class);
    }

    // /**
    //  * @return TypeDon[] Returns an array of TypeDon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeDon
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

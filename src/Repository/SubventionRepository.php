<?php

namespace App\Repository;

use App\Entity\Subvention;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Subvention|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subvention|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subvention[]    findAll()
 * @method Subvention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubventionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subvention::class);
    }

    // /**
    //  * @return Subvention[] Returns an array of Subvention objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Subvention
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

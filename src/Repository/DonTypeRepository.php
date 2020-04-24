<?php

namespace App\Repository;

use App\Entity\DonType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DonType|null find($id, $lockMode = null, $lockVersion = null)
 * @method DonType|null findOneBy(array $criteria, array $orderBy = null)
 * @method DonType[]    findAll()
 * @method DonType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DonType::class);
    }

    // /**
    //  * @return DonType[] Returns an array of DonType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DonType
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

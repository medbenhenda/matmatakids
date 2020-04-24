<?php

namespace App\Repository;

use App\Entity\FolderItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FolderItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method FolderItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method FolderItem[]    findAll()
 * @method FolderItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FolderItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FolderItem::class);
    }

    // /**
    //  * @return FolderItem[] Returns an array of FolderItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FolderItem
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

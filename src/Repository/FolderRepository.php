<?php

namespace App\Repository;

use App\Entity\Folder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @method Folder|null find($id, $lockMode = null, $lockVersion = null)
 * @method Folder|null findOneBy(array $criteria, array $orderBy = null)
 * @method Folder[]    findAll()
 * @method Folder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FolderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Folder::class);
    }

    // /**
    //  * @return Don[] Returns an array of Don objects
    //  */
    public function findActiveWithSumAmount()
    {
        return $this->createQueryBuilder('f')
          ->select('f')
            ->leftJoin('f.affectations', 'a')
            ->addSelect('SUM(a.amount) as amount_total')
            //->where('a.status = true')
            ->groupBy('f.id')

            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Folder[] Returns an array of Don objects
    //  */
    /**
     * @param Integer $id
     *
     * @return mixed
     */
    public function findFolderWithtransaction($id)
    {
        return $this->createQueryBuilder('f')
            ->select('f')
            ->leftJoin('f.proposingTransactions', 'p')->addSelect('p')
            ->leftJoin('f.affectations', 'a')->addSelect('a')
            ->where('f.id = :id')
            ->setParameter('id', $id)
            ->groupBy('f.id')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findNotAffected()
    {
        return $this->createQueryBuilder('f')
          ->select('f')
            ->where('f.satus = 0')
            ->getQuery()
            ->getResult()
        ;
    }
    // /**
    //  * @return Folder[] Returns an array of Folder objects
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
    public function findOneBySomeField($value): ?Folder
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

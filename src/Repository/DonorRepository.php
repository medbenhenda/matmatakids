<?php

namespace App\Repository;

use App\Entity\Donor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Donor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Donor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Donor[]    findAll()
 * @method Donor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Donor::class);
    }

     /**
      * @return Donor[] Returns an array of Donor objects
     */
    public function findDonors()
    {
        return $this->createQueryBuilder('d')
          ->select('d')
            ->join("d.dons", "p")->addSelect("p")
            ->addSelect('SUM(p.amount) AS total_sum', 'count(p.id) AS count_don')
            ->groupBy('d.id')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param Donor $donor
     * @return int|mixed|string
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findSumAmountOfDonor(Donor $donor)
    {
        return $this->createQueryBuilder('d')
            ->join("d.dons", "p")->addSelect("p")
            ->addSelect('SUM(p.amount) AS total_sum')
            ->where('d.id = :donor_id')
            ->setParameter('donor_id', $donor->getId())
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    // /**
    //  * @return Donor[] Returns an array of Donor objects
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
    public function findOneBySomeField($value): ?Donor
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

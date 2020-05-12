<?php

namespace App\Repository;

use App\Entity\Don;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\DoctrineExtension;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Don|null find($id, $lockMode = null, $lockVersion = null)
 * @method Don|null findOneBy(array $criteria, array $orderBy = null)
 * @method Don[]    findAll()
 * @method Don[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Don::class);
    }

    // /**
    //  * @return Don[] Returns an array of Don objects
    //  */
    /*public function findAll()
    {
        return $this->createQueryBuilder('d')
          ->select('d')
            ->join("d.donor", "p")->addSelect("p")
            ->getQuery()
            ->getResult()
        ;
    }*/

    /**
     * return the dons number grouped by month/year
     * the returned data is used for the chart in dashboard
     * @return mixed[]
     * @throws DBALException
     */
    public function getDonsGroupedByMonth()
    {
        $sql = "SELECT date_format(date, '%M-%Y') as date_don , count('id') as count_don 
                from don GROUP BY YEAR(date), MONTH(date) order by year('date'), month(date) ASC";
        $conn = $this->getEntityManager()
            ->getConnection();

        $stmt = $conn->prepare($sql);

        $stmt->execute();
        $data = $stmt->fetchAll();
        $result = [];
        foreach ($data as $item) {
            $result['labels'][] = $item['date_don'];
            $result['values'][] = $item['count_don'];
        }

        return $result;
    }

    /**
     * return the dons number grouped by projecs
     * the returned data is used for the chart in dashboard
     * @return mixed[]
     * @throws DBALException
     */
    public function getDonsGroupedByProject()
    {
        return $this->createQueryBuilder('d')
            //->leftJoin('d.project', 'p')
            ->addSelect('count(d.project) as count_project')
            ->groupBy('d.project')
            ->getQuery()
            ->getResult()
            ;
    }
    // /**
    //  * @return Don[] Returns an array of Don objects
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
    public function findOneBySomeField($value): ?Don
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

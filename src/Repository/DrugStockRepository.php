<?php

namespace App\Repository;

use App\Entity\DrugStock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DrugStock|null find($id, $lockMode = null, $lockVersion = null)
 * @method DrugStock|null findOneBy(array $criteria, array $orderBy = null)
 * @method DrugStock[]    findAll()
 * @method DrugStock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DrugStockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DrugStock::class);
    }

    // /**
    //  * @return DrugStock[] Returns an array of DrugStock objects
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
    public function findOneBySomeField($value): ?DrugStock
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

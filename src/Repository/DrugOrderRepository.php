<?php

namespace App\Repository;

use App\Entity\DrugOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DrugOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method DrugOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method DrugOrder[]    findAll()
 * @method DrugOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DrugOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DrugOrder::class);
    }

    // /**
    //  * @return DrugOrder[] Returns an array of DrugOrder objects
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
    public function findOneBySomeField($value): ?DrugOrder
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

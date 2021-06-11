<?php

namespace App\Repository;

use App\Entity\CarerTakerOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarerTakerOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarerTakerOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarerTakerOrder[]    findAll()
 * @method CarerTakerOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarerTakerOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarerTakerOrder::class);
    }

    // /**
    //  * @return CarerTakerOrder[] Returns an array of CarerTakerOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CarerTakerOrder
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

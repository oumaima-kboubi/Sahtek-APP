<?php

namespace App\Repository;

use App\Entity\CareTakerOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CareTakerOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method CareTakerOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method CareTakerOrder[]    findAll()
 * @method CareTakerOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarerTakerOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CareTakerOrder::class);
    }

    public function findForWeek($id, $today, $week)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            " select c.id, c.day, c.startTime, c.finishTime, c.price, c.approved, c.deleted
            from App\Entity\CareTakerOrder c
            where  c.client = :val and c.day > :week and c.day < :today and c.deleted = 0
            order by c.day DESC")
            ->setParameter('val', $id)
            ->setParameter('week', $week)
            ->setParameter('today', $today)
            ->getResult()
            ;
    }

    public function findForMonth($id, $week, $month)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            " select c.id, c.day, c.startTime, c.finishTime, c.price, c.approved, c.deleted
            from App\Entity\CareTakerOrder c
            where c.client = :val and c.day > :month and c.day < :week and c.deleted = 0
            order by c.day DESC")
            ->setParameter('val', $id)
            ->setParameter('week', $week)
            ->setParameter('month', $month)
            ->getResult()
            ;
    }

    public function findTheRest($id, $month)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            " select c.id, c.day, c.startTime, c.finishTime, c.price, c.approved, c.deleted
            from App\Entity\CareTakerOrder c
            where c.client = :val and c.day < :month and c.deleted = 0
            order by c.day DESC")
            ->setParameter('val', $id)
            ->setParameter('month', $month)
            ->getResult()
            ;
    }

    public function findOrder($id)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            " select p.birthDate, p.lastName, p.firstName, p.city, c.startTime, c.finishTime, c.day, c.price, p.featured_image
            from App\Entity\CareTakerOrder c, App\Entity\User p
            where c.client = :val and c.pending =1 and p.id= c.caretaker")
            ->setParameter('val', $id)
            ->getResult()
            ;
    }

    // /**
    //  * @return CareTakerOrder[] Returns an array of CareTakerOrder objects
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
    public function findOneBySomeField($value): ?CareTakerOrder
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

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

    public function findForWeek($id, $today, $week)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            " select d.id, d.price, d.createdAt, d.Approved, d.description, d.quantity, d.featured_image, d.pending
            from App\Entity\DrugOrder d
            where d.client = :val and d.createdAt > :week and d.createdAt < :today and d.deleted = 0
            order by d.createdAt DESC")
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
            " select d.id, d.price, d.createdAt, d.Approved, d.description, d.quantity, d.featured_image, d.pending
            from App\Entity\DrugOrder d
            where d.client = :val and d.createdAt > :month and d.createdAt < :week and d.deleted = 0
            order by d.createdAt DESC")
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
            " select d.id, d.price, d.createdAt, d.Approved, d.description, d.quantity, d.featured_image, d.pending
            from App\Entity\DrugOrder d
            where d.client = :val and d.createdAt < :month and d.deleted = 0
            order by d.createdAt DESC")
            ->setParameter('val', $id)
            ->setParameter('month', $month)
            ->getResult()
            ;
    }

    public function monthlyEarning($month)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            " select SUM(d.price)
            from App\Entity\DrugOrder d
            where d.createdAt > :month")
            ->setParameter('month', $month)
            ->getResult()
            ;
    }

    public function yearlyEarning($year)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            " select SUM(d.price) 
            from App\Entity\DrugOrder d
            where d.createdAt > :year")
            ->setParameter('year', $year)
            ->getResult()
            ;
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
    public function findOrder($id)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            " select p.birthDate, p.lastName, p.firstName, p.city, d.description, d.quantity, d.price, d.createdAt, r.Name
        from App\Entity\DrugOrder d, App\Entity\User p, App\Entity\Drug r
        where d.client = :val and p.id = d.client and d.Drug = r.id and d.pending =1")
            ->setParameter('val', $id)
            ->getResult()
            ;
    }
}

<?php

namespace App\Repository;

use App\Entity\Entrprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entrprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entrprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entrprise[]    findAll()
 * @method Entrprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrpriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entrprise::class);
    }

    // /**
    //  * @return Entrprise[] Returns an array of Entrprise objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Entrprise
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

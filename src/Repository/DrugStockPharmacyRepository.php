<?php

namespace App\Repository;

use App\Entity\DrugStockPharmacy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DrugStockPharmacy|null find($id, $lockMode = null, $lockVersion = null)
 * @method DrugStockPharmacy|null findOneBy(array $criteria, array $orderBy = null)
 * @method DrugStockPharmacy[]    findAll()
 * @method DrugStockPharmacy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DrugStockPharmacyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DrugStockPharmacy::class);
    }

    // /**
    //  * @return DrugStockPharmacy[] Returns an array of DrugStockPharmacy objects
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
    public function findOneBySomeField($value): ?DrugStockPharmacy
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

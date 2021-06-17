<?php

namespace App\Repository;

use App\Entity\Drug;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Drug|null find($id, $lockMode = null, $lockVersion = null)
 * @method Drug|null findOneBy(array $criteria, array $orderBy = null)
 * @method Drug[]    findAll()
 * @method Drug[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DrugRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Drug::class);
    }

    /**
     * @return Drug[] Returns an array of Drug objects
     *
     */

    public function findByCategory($value)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            " select p.birthDate, p.lastName, p.firstName, p.city, c.startTime, c.finishTime, c.day, c.price, p.featured_image
            from App\Entity\CareTakerOrder c, App\Entity\User p
            where c.client = :val and c.pending =1 and p.id= c.caretaker")
            ->setParameter('val', $value)
            ->getResult()
            ;

    }



}

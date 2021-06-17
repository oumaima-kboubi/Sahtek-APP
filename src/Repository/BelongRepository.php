<?php

namespace App\Repository;

use App\Entity\Belong;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Belong|null find($id, $lockMode = null, $lockVersion = null)
 * @method Belong|null findOneBy(array $criteria, array $orderBy = null)
 * @method Belong[]    findAll()
 * @method Belong[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BelongRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Belong::class);
    }

    public function findThe($id)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            " select c.Name, c.price, c.description, c.featured_image, c.id
        from App\Entity\Drug c, App\Entity\Belong b
        where b.pharmacy = :val and b.drug=c.id")
            ->setParameter('val', $id)
            ->getResult()
            ;
    }
}

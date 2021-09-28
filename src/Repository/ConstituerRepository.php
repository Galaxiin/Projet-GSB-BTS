<?php

namespace App\Repository;

use App\Entity\Constituer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Constituer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Constituer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Constituer[]    findAll()
 * @method Constituer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConstituerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Constituer::class);
    }

    // /**
    //  * @return Constituer[] Returns an array of Constituer objects
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
    public function findOneBySomeField($value): ?Constituer
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

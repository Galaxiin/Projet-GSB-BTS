<?php

namespace App\Repository;

use App\Entity\Prescrire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Prescrire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prescrire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prescrire[]    findAll()
 * @method Prescrire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrescrireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prescrire::class);
    }

    // /**
    //  * @return Prescrire[] Returns an array of Prescrire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Prescrire
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

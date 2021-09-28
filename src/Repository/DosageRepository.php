<?php

namespace App\Repository;

use App\Entity\Dosage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dosage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dosage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dosage[]    findAll()
 * @method Dosage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DosageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dosage::class);
    }

    // /**
    //  * @return Dosage[] Returns an array of Dosage objects
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
    public function findOneBySomeField($value): ?Dosage
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

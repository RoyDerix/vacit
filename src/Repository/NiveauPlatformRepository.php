<?php

namespace App\Repository;

use App\Entity\NiveauPlatform;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NiveauPlatform|null find($id, $lockMode = null, $lockVersion = null)
 * @method NiveauPlatform|null findOneBy(array $criteria, array $orderBy = null)
 * @method NiveauPlatform[]    findAll()
 * @method NiveauPlatform[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NiveauPlatformRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NiveauPlatform::class);
    }

    // /**
    //  * @return NiveauPlatform[] Returns an array of NiveauPlatform objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NiveauPlatform
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

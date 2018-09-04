<?php

namespace App\Repository;

use App\Entity\Scans;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Scans|null find($id, $lockMode = null, $lockVersion = null)
 * @method Scans|null findOneBy(array $criteria, array $orderBy = null)
 * @method Scans[]    findAll()
 * @method Scans[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScansRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Scans::class);
    }

//    /**
//     * @return Scans[] Returns an array of Scans objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Scans
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

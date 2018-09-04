<?php

namespace App\Repository;

use App\Entity\Raters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Raters|null find($id, $lockMode = null, $lockVersion = null)
 * @method Raters|null findOneBy(array $criteria, array $orderBy = null)
 * @method Raters[]    findAll()
 * @method Raters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RatersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Raters::class);
    }

//    /**
//     * @return Raters[] Returns an array of Raters objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Raters
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

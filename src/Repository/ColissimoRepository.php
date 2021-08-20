<?php

namespace App\Repository;

use App\Entity\Colissimo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Colissimo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Colissimo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Colissimo[]    findAll()
 * @method Colissimo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColissimoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Colissimo::class);
    }

    // /**
    //  * @return Colissimo[] Returns an array of Colissimo objects
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
    public function findOneBySomeField($value): ?Colissimo
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

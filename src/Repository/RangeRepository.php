<?php

namespace App\Repository;

use App\Entity\RangeValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RangeValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method RangeValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method RangeValue[]    findAll()
 * @method RangeValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RangeValue::class);
    }

    /**
     * @return RangeValue|null Returns an array of Range objects
     */
    public function findAndOrderByMax($max, $countries_id)
    {
        return $this->createQueryBuilder('r')
            ->where('r.max >= :val')
            // ->andWhere('r.countries IN [:countries_id]')
            ->setParameter('val', $max)
            // ->setParameter('countries_id', $countries_id)
            ->orderBy('r.max', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult()
        ;
    }

    public function findCountry($id)
    {
        return $this->createQueryBuilder('r')
            ->where('r.countries IN :ids')
            ->setParameter('ids', [$id])
            ->getQuery()
            ->getFirstResult()
            ;
    }
}

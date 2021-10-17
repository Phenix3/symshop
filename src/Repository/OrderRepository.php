<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function findOneByUserForCheckout(UserInterface $user): ?Order
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.user = :user')
            ->setParameter('user', $user)
            ->orderBy('o.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findForShow(string $id): ?Order {
        return $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->setParameter('id', $id)
            ->join('o.user', 'user')
            ->addSelect('user')
            ->getQuery()
            ->getResult();
    }

    /**
     * Undocumented function
     *
     * @param UserInterface $user
     * @return Order[]|null
     */
    public function findAllForUser(UserInterface $user)
    {
        return $this->createQueryBuilder('o')
        // ->select('o.id', 'o.reference', 'o.createdAt', 'o.total', 'o.state', 'o.user')
            ->where('o.user = :user')
            ->join('o.state', 'state')
            ->join('o.user', 'user')
            ->addSelect('state', 'user')
            ->setParameter('user', $user)
            ->orderBy('o.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return int
     */
    final public function countForReference(): int
    {
        $query = $this->count([]);

        return $query;
    }

}

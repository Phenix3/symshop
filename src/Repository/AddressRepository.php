<?php

namespace App\Repository;

use App\Entity\Address;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Address|null find($id, $lockMode = null, $lockVersion = null)
 * @method Address|null findOneBy(array $criteria, array $orderBy = null)
 * @method Address[]    findAll()
 * @method Address[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Address::class);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return Address|null
     */
    public function findWithCountry($id)
    {
        return $this->createQueryBuilder('address')
            ->innerJoin('address.country', 'country')
            ->addSelect('country')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findToCompare(array $data): ?Address
    {
        return $this->createQueryBuilder('address')
            ->andWhere('address.address = :addr')
            ->andWhere('address.user = :user')
            ->andWhere('address.country = :country')
            ->setParameters([
                'addr' => $data['address'],
                'user' => $data['user'],
                'country' => $data['country']
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Undocumented function
     *
     * @return Address[]|null
     */
    public function findAllForUser(UserInterface $user): array
    {
        return $this->createQueryBuilder('a')
            ->where('a.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
}

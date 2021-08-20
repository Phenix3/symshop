<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @return QueryBuilder
     */
    public function findForSearchBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('c')
            ->where('c.enabled = :status')
            ->leftJoin('c.children', 'children')
            ->addSelect( 'children')
            ->setParameter('status', true)
            ;
    }

    /**
     * @param string $parentSlug
     * @return Category[]
     */
    public function findChildren(string $parentSlug): array
    {
        return $this->createQueryBuilder('c')
            ->addSelect('child')
            ->innerJoin('c.parent', 'parent')
            ->leftJoin('c.children', 'child')
            ->andWhere('parent.slug = :parentSlug')
            ->setParameter('parentSlug', $parentSlug)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param string $slug
     * @return Category
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneBySlug(string $slug): Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }


    /**
     * @return Category[]
     */
    public function findRootNodes(): array
    {
        return $this->createQueryBuilder('c')
//            ->leftJoin('c.parent', 'parent')
            ->leftJoin('c.children', 'child')
            ->select('c', 'child')
            ->andWhere('c.parent IS NULL')
            ->andWhere('c.enabled = :status')
            ->setParameter('status', true)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param string $phrase
     * @param int|null $limit
     * @return Category[]
     */
    public function findByNamePart(string $phrase, ?int $limit = null): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name LIKE :name')
            ->setParameter('name', '%' . $phrase . '%')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }

}

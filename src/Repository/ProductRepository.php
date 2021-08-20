<?php

namespace App\Repository;

use App\DataClass\SearchData;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findAllQuery(): Query
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery();
    }

    public function findLatests(int $limit = 6)
    {
        return $this->createQueryBuilder('p')
            ->setMaxResults($limit)
            ->leftJoin('p.image', 'image')
            ->leftJoin('p.categories', 'c', Expr\Join::WITH, 'c.enabled = :status')
            ->select('p', 'image', 'c')
            ->where('p.isActive = :active')
            ->setParameter('active', true)
            ->setParameter('status', true)
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;

    }

    public function findSearchQuery(SearchData $search)
    {
        $query = $this
            ->createQueryBuilder('p')
            ->leftJoin('p.image', 'image')
                ->leftJoin('p.categories', 'c', Expr\Join::WITH, 'c.enabled = :status')
            ->select('p', 'c', 'image')
            ->where('p.isActive = :active')
            ->setParameter('active', true)
            ->setParameter('status', true)
            ;

        if (!empty($search->q)) {
            $query = $query->andWhere('p.name LIKE :q')->setParameter('q', "%{$search->q}%");
        }

        if ($search->min != null) {
            $query = $query->andWhere('p.price >= :min')->setParameter('min', $search->min);
        }

        if ($search->max != null) {
            $query = $query->andWhere('p.price <= :max')->setParameter('max', $search->max);
        }

        if (!empty($search->categories)) {
            /** @var Category[] $categories */
            $categories = $search->categories;

            $query = $query
                ->andWhere('c IN (:categories)')
                ->setParameter('categories', $categories)
                ;

        }

        $query = $query->getQuery();

        return $query;
    }

    /**
     * @param string $slug
     * @return Product|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findWithImages(string $slug): ?Product
    {
        return $this
            ->createQueryBuilder('p')
            ->leftJoin('p.image', 'image')
            ->leftJoin('p.images', 'images')
            ->leftJoin('p.reviews', 'r', Expr\Join::WITH, 'r.status = :status')
            ->addSelect('image', 'images', 'r')
            ->where('p.slug = :slug')
            ->setParameter('slug', $slug)
            ->setParameter('status', Review::REVIEW_STATUS_ACCEPTED)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

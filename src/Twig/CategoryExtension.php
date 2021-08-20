<?php

namespace App\Twig;

use App\Repository\CategoryRepository;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class CategoryExtension extends AbstractExtension implements GlobalsInterface
{
    private CategoryRepository $categoryRepository;
    /**
     * @var TagAwareCacheInterface
     */
    private TagAwareCacheInterface $cache;

    public function __construct(
        CategoryRepository $categoryRepository,
        TagAwareCacheInterface $cache
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->cache = $cache;
    }


    /**
     * @return array
     */
    public function getGlobals()
    {

        $categories = $this->cache->get('nav_categories', function (ItemInterface $item) {
            $item->tag('nav_categories_tag');
            $categories = $this->categoryRepository->findRootNodes();
            return $categories;
        });

        return [
            'nav_categories' => $categories
        ];
    }
}

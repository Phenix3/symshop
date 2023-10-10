<?php

namespace App\Twig;

use App\Repository\CategoryRepository;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class CategoryExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(private CategoryRepository $categoryRepository, private TagAwareCacheInterface $cache)
    {
    }


    /**
     * @return array
     */
    public function getGlobals(): array
    {

        $categories = $this->cache->get('nav_categories', function (ItemInterface $item) {
            $item->tag('nav_categories_tag');
            return $this->categoryRepository->findRootNodes();
        });

        return [
            'nav_categories' => $categories
        ];
    }
}

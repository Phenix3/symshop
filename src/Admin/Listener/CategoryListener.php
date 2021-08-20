<?php


namespace App\Admin\Listener;


use App\Admin\Event\Category\CategoryCreated;
use App\Admin\Event\Category\CategoryUpdated;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class CategoryListener implements EventSubscriberInterface
{
    /**
     * @var TagAwareCacheInterface
     */
    private TagAwareCacheInterface $cache;

    public function __construct(TagAwareCacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            CategoryCreated::class => 'onCategoryCreated',
            CategoryUpdated::class => 'onCategoryUpdated'
        ];
    }

    /**
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function onCategoryCreated(CategoryCreated $event): void
    {
        dump('CategoryCreated', $event->getCategory());
        $this->invalidateTags(['nav_categories_tag']);
    }

    /**
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function onCategoryUpdated(CategoryUpdated $event): void
    {
        dump('CategoryUpdated', $event->getCategory());
        $this->invalidateTags(['nav_categories_tag']);
    }

    /**
     * @param array $tags
     * @throws \Psr\Cache\InvalidArgumentException
     */
    private function invalidateTags(array $tags): void
    {
        $this->cache->invalidateTags($tags);
    }
}
<?php


namespace App\Admin\Listener;


use Psr\Cache\InvalidArgumentException;
use App\Admin\Event\Category\CategoryCreated;
use App\Admin\Event\Category\CategoryUpdated;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class CategoryListener implements EventSubscriberInterface
{
    public function __construct(private TagAwareCacheInterface $cache)
    {
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
     * @throws InvalidArgumentException
     */
    public function onCategoryCreated(CategoryCreated $event): void
    {
        dump('CategoryCreated', $event->getCategory());
        $this->invalidateTags(['nav_categories_tag']);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function onCategoryUpdated(CategoryUpdated $event): void
    {
        dump('CategoryUpdated', $event->getCategory());
        $this->invalidateTags(['nav_categories_tag']);
    }

    /**
     * @throws InvalidArgumentException
     */
    private function invalidateTags(array $tags): void
    {
        $this->cache->invalidateTags($tags);
    }
}
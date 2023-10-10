<?php


namespace App\EventSubscriber;

use App\Entity\Attachment;
use App\Entity\Product;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheEventSubscriber implements EventSubscriber
{
    public function __construct(private CacheManager $cacheManager, private UploaderHelper $uploaderHelper)
    {
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::preUpdate,
            Events::preRemove
        ];
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Product) {
            return;
        }

        if (null !== $entity->getImage() && $entity->getImage()->getFile() instanceof UploadedFile) {
            $this->cacheManager->remove(
                $this->uploaderHelper->asset($entity->getImage(), 'file')
            );
        }
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Attachment) {
            return;
        }
//        dump($entity);

        $this->cacheManager->remove(
            $this->uploaderHelper->asset($entity, 'file')
        );
    }
}

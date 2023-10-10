<?php

namespace App\EntityListener;

use App\Entity\Product;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ProductEntityListener
{
    public function __construct(private CacheManager $imagineCacheManager, private UploaderHelper $uploaderHelper)
    {
    }
    
    public function postLoad(Product $product, LifecycleEventArgs $event)
    {
        // dump($product);
        if (!empty($product->getImage())) {
            $product
                ->setImagePaths([
                    'mini' => $this->imagineCacheManager->getBrowserPath($this->uploaderHelper->asset($product->getImage(), 'file'), 'mini'),
                    'thumb' => $this->imagineCacheManager->getBrowserPath($this->uploaderHelper->asset($product->getImage(), 'file'), 'thumb'),
                    'medium' => $this->imagineCacheManager->getBrowserPath($this->uploaderHelper->asset($product->getImage(), 'file'), 'medium'),
                ])
            ;
        } else {
            $product
                ->setImagePaths([
                    'mini' => $this->imagineCacheManager->getBrowserPath('/images/empty-product.jpg', 'mini'),
                    'thumb' => $this->imagineCacheManager->getBrowserPath('/images/empty-product.jpg', 'thumb'),
                    'medium' => $this->imagineCacheManager->getBrowserPath('/images/empty-product.jpg', 'medium'),
                ])
            ;
        }
//        dump($product);
    }
}

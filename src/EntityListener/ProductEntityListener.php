<?php

namespace App\EntityListener;

use App\Entity\Product;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Twig\Extra\Markdown\MarkdownInterface;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ProductEntityListener
{
    private $imagineCacheManager;

    private $slugger;
    /**
     * @var UploaderHelper
     */
    private UploaderHelper $uploaderHelper;


    public function __construct(
        CacheManager $imagineCacheManager,
        UploaderHelper $uploaderHelper,
        SluggerInterface $slugger
        ) {
        $this->imagineCacheManager = $imagineCacheManager;
        $this->uploaderHelper = $uploaderHelper;
        $this->slugger = $slugger;
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

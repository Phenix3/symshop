<?php

namespace App\Twig;

use App\Repository\ShopRepository;
use App\Service\Cart\CartService;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension implements GlobalsInterface
{
    private $shopRepository;
    private $cartService;
    private $serializer;
    /**
     * @var CacheInterface
     */
    private CacheInterface $cache;

    public function __construct(
        ShopRepository $shopRepository,
        CartService $cartService,
        SerializerInterface $serializer,
        TagAwareCacheInterface $cache
        ) {
        $this->shopRepository = $shopRepository;
        $this->cartService = $cartService;
        $this->serializer = $serializer;
        $this->cache = $cache;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('active_class', [$this, 'getActiveClass'], [
                'needs_context' => true
            ]),
            new TwigFunction('icon_svg', [$this, 'svgIcon'], ['is_safe' => ['html']])
        ];
    }

    public function getActiveClass(array $context, string $routeName, string $activeClass = 'active')
    {
        $request = $context['app']->getRequest();
        return $request->attributes->get('_route') === $routeName ? " {$activeClass} " : "";
    }

    public function getGlobals(): array
    {
        $shop = $this->cache->get('shop', function (ItemInterface $item) {
            $item->tag('shop_tag');
            $shop = $this->shopRepository->findFirst();
            return $shop;
        });
        return [
            'shop' => $shop,
            'shopJson' => $this->serializer->serialize($shop, 'json'),
            'cartCount' => $this->cartService->getContent()->count(),
            'cartTotal' => $this->cartService->getTotal(),
            'cart' => $this->cartService->getContent(),
        ];
    }

    public function svgIcon(string $name, ?int $size = null): string
    {
        $attrs = '';
        if ($size) {
            $attrs = " width=\"{$size}px\" height=\"{$size}px\"";
        }

        return <<<HTML
            <svg class="icon icon-{$name}"{$attrs}>
                <use xlink:href="/sprite.svg#{$name}"></use>
            </svg>
        HTML;

    }
}

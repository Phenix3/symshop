<?php

namespace App\Twig;

use App\Repository\ShopRepository;
use App\Service\Cart\CartService;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(private ShopRepository $shopRepository, private CartService $cartService, private SerializerInterface $serializer, private TagAwareCacheInterface $cache)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('active_class', fn(array $context, string $routeName, string $activeClass = 'active') => $this->getActiveClass($context, $routeName, $activeClass), [
                'needs_context' => true
            ]),
            new TwigFunction('icon_svg', fn(string $name, ?int $size = null): string => $this->svgIcon($name, $size), ['is_safe' => ['html']])
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
            return $this->shopRepository->findFirst();
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

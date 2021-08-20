<?php

namespace App\Twig;

use App\Repository\SettingRepository;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;

class SettingExtension extends AbstractExtension implements GlobalsInterface
{
    protected $settingRepository;
    /**
     * @var TagAwareCacheInterface
     */
    private TagAwareCacheInterface $cache;

    public function __construct(SettingRepository $settingRepository, TagAwareCacheInterface $cache)
    {
        $this->settingRepository = $settingRepository;
        $this->cache = $cache;
    }

    
    public function getFunctions(): array
    {
        return [
            new TwigFunction('setting', [$this, 'getSetting'], ['needs_context' => true, 'is_safe' => ['html']]),
        ];
    }

    public function getSetting(array $context, $keyName, $default = '')
    {
        $settings = $context['global_settings'];
        $setting = array_reduce(
                        array_filter(
                            $settings,
                            static function ($setting) use ($keyName) {
                        return $setting->getKeyName() === $keyName;
                    }
                ), static function($key, $setting) use ($keyName) {
                        return $setting->getKeyName() === $keyName ? $setting : null;
                    }
                );

        return $setting ? $setting->getValue() : $default;
    }

    public function getGlobals()
    {
        $settings = $this->cache->get('global_settings', function(ItemInterface $item) {
            $item->tag('global_settings_tag');
            return $this->settingRepository->findAll();
        });
        return [
            'global_settings' => $settings
        ];
    }

    
}

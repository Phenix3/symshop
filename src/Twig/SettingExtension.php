<?php

namespace App\Twig;

use App\Repository\SettingRepository;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;

class SettingExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(protected SettingRepository $settingRepository, private TagAwareCacheInterface $cache)
    {
    }

    
    public function getFunctions(): array
    {
        return [
            new TwigFunction('setting', fn(array $context, $keyName, $default = '') => $this->getSetting($context, $keyName, $default), ['needs_context' => true, 'is_safe' => ['html']]),
        ];
    }

    public function getSetting(array $context, $keyName, $default = '')
    {
        $settings = $context['global_settings'];
        $setting = array_reduce(
                        array_filter(
                            $settings,
                            static fn($setting) => $setting->getKeyName() === $keyName
                ), static fn($key, $setting) => $setting->getKeyName() === $keyName ? $setting : null
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

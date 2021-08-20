<?php


namespace App\Admin\Event\Setting;


use App\Entity\Setting;

class SettingCreated
{
    /**
     * @var Setting
     */
    private Setting $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function getSetting()
    {
        return $this->setting;
    }
}
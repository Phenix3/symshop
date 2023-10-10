<?php


namespace App\Admin\Event\Setting;


use App\Entity\Setting;

class SettingCreated
{
    public function __construct(private Setting $setting)
    {
    }

    public function getSetting()
    {
        return $this->setting;
    }
}
<?php


namespace App\Admin\Event\Setting;


use App\Entity\Setting;

class SettingUpdated
{

    public function __construct(private Setting $setting, private Setting $oldSetting)
    {
    }

    public function getSetting()
    {
        return $this->setting;
    }

    public function getOldSetting(): Setting
    {
        return $this->oldSetting;
    }
}
<?php


namespace App\Admin\Event\Setting;


use App\Entity\Setting;

class SettingUpdated
{

    /**
     * @var Setting
     */
    private Setting $setting;
    /**
     * @var Setting
     */
    private Setting $oldSetting;


    public function __construct(Setting $setting, Setting $oldSetting)
    {
        $this->setting = $setting;
        $this->oldSetting = $oldSetting;
    }

    public function getSetting()
    {
        return $this->setting;
    }

    /**
     * @return Setting
     */
    public function getOldSetting(): Setting
    {
        return $this->oldSetting;
    }
}
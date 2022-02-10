<?php

namespace App\Actions;

use App\Models\Setting;

class SettingActions
{
    private Setting $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function getParams()
    {
        return $this->setting->first();
    }
}

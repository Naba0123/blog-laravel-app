<?php

if (!function_exists('setting')) {
    /**
     * ブログ設定値を取得
     *
     * @param string $key
     * @return string
     */
    function setting(string $key, string $default = ''): string
    {
        $setting = app(\App\Services\SettingService::class)->getSetting($key);
        return is_null($setting) ? $default : $setting->value;
    }
}


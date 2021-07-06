<?php

if (!function_exists('str')) {
    /**
     * ブログ設定値を取得
     *
     * @param string $key
     * @return string
     */
    function str(string $baseStr): string
    {
        $value = app(\App\Services\SettingService::class)->getSetting($key);
        return is_null($value) ? $default : $value;
    }
}


<?php


namespace App\Services;


use App\Models\Common\CBlogSetting;

class SettingService extends AbstractService
{
    /**
     * ブログ設定値を取得
     *
     * @param string $key
     * @return string|null
     */
    public function getSetting(string $key): ?string
    {
        return CBlogSetting::gets()->where('key', $key)->first();
    }
}

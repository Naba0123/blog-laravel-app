<?php


namespace App\Services;


use App\Models\Common\CBlogSetting;

class SettingService extends AbstractService
{
    /**
     * ブログ設定値を取得
     *
     * @param string $key
     * @return CBlogSetting|null
     */
    public function getSetting(string $key): ?CBlogSetting
    {
        return CBlogSetting::gets()->where('key', $key)->first();
    }

    /**
     * ブログ設定値を設定
     *
     * @param array $settingValues
     */
    public function saveSetting(array $settingValues)
    {
        $cBlogSettings = CBlogSetting::gets()->keyBy('key');
        foreach ($settingValues as $settingKey => $settingValue) {
            // 設定できないキーは無視
            if (!in_array($settingKey, CBlogSetting::ENABLE_SETTING_KEYS)) {
                continue;
            }
            if (($cBlogSetting = $cBlogSettings->get($settingKey)) === null) {
                $cBlogSetting = new CBlogSetting(['key' => $settingKey]);
            }
            $cBlogSetting->value = $settingValue;
            $cBlogSetting->save();
        }
    }
}

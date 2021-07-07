<?php

use App\Models\Common\CBlogSetting;
use Illuminate\Database\Seeder;

class CBlogSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = carbon_now()->toDateTimeString();
        $inserts = array_map(function($settingKey) use ($now) {
            return [
                'key' => $settingKey,
                'value' => config('blog.common.default_values.' . $settingKey, ''),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, CBlogSetting::ENABLE_SETTING_KEYS);

        \DB::table(CBlogSetting::getTableName())->insert($inserts);
    }
}

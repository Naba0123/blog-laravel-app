<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::transaction(function() {
            $this->call(CUsersTableSeeder::class);
            $this->call(CBlogSettingSeeder::class);
        });
    }
}

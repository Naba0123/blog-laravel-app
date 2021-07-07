<?php

use App\User;
use Illuminate\Database\Seeder;

class CUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table((new User())->getTable())->insert([
            'name' => 'admin',
            'email' => config('user.admin.email'),
            'password' => \Hash::make(config('user.admin.password')),
        ]);
    }
}

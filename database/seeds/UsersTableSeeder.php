<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'username' => config('user.admin.username'),
            'password_hash' => \Hash::make(config('user.admin.password')),
        ]);
    }
}

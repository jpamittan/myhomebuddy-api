<?php

namespace Database\Seeders;

use Hash, Str;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Admin',
            'middle_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@myhomebuddy.com',
            'type' => 'Admin',
            'password' => Hash::make('password123')
        ]);
    }
}

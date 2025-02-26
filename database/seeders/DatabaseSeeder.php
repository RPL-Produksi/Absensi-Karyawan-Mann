<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'fullname' => env('ADMIN_FULLNAME'),
            'username' => env('ADMIN_USERNAME'),
            'email' => env('ADMIN_EMAIL'),
            'password' => bcrypt(env('ADMIN_PASSWORD')),
            'address' => env('ADMIN_ADDRESS'),
            'phone_number' => env('ADMIN_PHONE'),
            'position' => env('ADMIN_POSITION'),
            'role' => 'admin',
        ]);
    }
}

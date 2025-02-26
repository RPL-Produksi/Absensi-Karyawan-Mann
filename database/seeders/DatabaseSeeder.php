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
        // $table->uuid('id')->primary();
        // $table->string('fullname');
        // $table->text('address');
        // $table->string('phone_number')->unique();
        // $table->string('email')->unique();
        // $table->string('position');
        // $table->string('password');
        // $table->rememberToken();
        // $table->timestamps();
        User::create([
            'fullname' => 'John Doe',
            'address' => '123 Main St, Springfield, IL 62701',
            'phone_number' => '555-555-5555',
            'email' => 'john@example.com',
            'username' => 'johndoe',
            'position' => 'Software Engineer',
            'password' => bcrypt('password'),
        ]);
    }
}

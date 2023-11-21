<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

       //Create 2 users, 1 admin and 1 normal user
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@likmi.ac.id',
            'password' => bcrypt('12345678'),
            'phone_number' => '08123456789',
            'date_of_birth' => '1999-01-01',
            'is_admin' => true,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Ferdinand',
            'email' => 'ferdinand@likmi.ac.id',
            'password' => bcrypt('12345678'),
            'phone_number' => '08123456788',
            'date_of_birth' => '1999-01-01',
            'is_admin' => false,
        ]);

        $this->call([
            ArticleSeeder::class,
            TagSeeder::class,
        ]);
    }
}

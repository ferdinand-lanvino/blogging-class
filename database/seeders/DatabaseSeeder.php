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

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@likmi.ac.id',
            'password' => bcrypt('12345678'),
            'phone_number' => '081234567890',
            'date_of_birth' => '1990-01-01',
            'is_admin' => 1,
        ]);


        \App\Models\User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@likmi.ac.id',
            'password' => bcrypt('12345678'),
            'phone_number' => '081234567899',
            'date_of_birth' => '1990-01-01',
            'is_admin' => 0,
        ]);

        $this->call([
            ArticleSeeder::class,
        ]);
    }
}

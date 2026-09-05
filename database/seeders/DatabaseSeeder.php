<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'sarah@example.com'],
            [
                'firstname' => 'Sarah',
                'lastname' => 'Admin',
                'username' => 'sarah',
                'password' => 'password',
                'role' => 'admin',
            ],
        );

        if (User::count() === 1) {
            User::factory(10)->create();
        }

        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}

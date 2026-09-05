<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(
            ['title' => 'Web Development'],
            ['description' => 'Build modern websites and web applications.'],
        );

        Category::firstOrCreate(
            ['title' => 'Artificial Intelligence'],
            ['description' => 'News and tutorials about AI and machine learning.'],
        );

        Category::firstOrCreate(
            ['title' => 'Cloud Computing'],
            ['description' => 'Deploy and scale applications in the cloud.'],
        );

        Category::firstOrCreate(
            ['title' => 'Cybersecurity'],
            ['description' => 'Protect systems, networks and data from attacks.'],
        );
    }
}

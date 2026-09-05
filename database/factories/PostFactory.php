<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6),
            'category_id' => Category::query()->inRandomOrder()->value('id') ?? Category::factory(),
            'body' => fake()->paragraphs(4, true),
            'is_featured' => fake()->boolean(20),
            'thumbnail' => null,
        ];
    }
}

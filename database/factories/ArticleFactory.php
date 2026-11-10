<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(5);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->randomNumber(4),
            'category' => fake()->randomElement(['mental_health', 'relationship', 'parenting', 'depression']),
            'summary' => fake()->paragraph(),
            'content' => fake()->paragraphs(3, true),
            'author_name' => 'Pakar Sakeenah Medicare',
            'image_path' => 'media/services/Symptoms-of-depression.png',
            'read_time_minutes' => 4,
            'is_published' => true,
            'published_at' => now(),
        ];
    }
}

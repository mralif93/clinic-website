<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(3, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.fake()->unique()->randomNumber(4),
            'category' => fake()->randomElement(['psychotherapy', 'assessment', 'child_therapy', 'corporate']),
            'summary' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'target_audience' => 'Dewasa & Kanak-kanak',
            'price' => fake()->randomElement([150.00, 200.00, 300.00]),
            'deposit_amount' => 50.00,
            'duration_minutes' => 60,
            'allows_online' => true,
            'allows_in_person' => true,
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 1,
        ];
    }
}

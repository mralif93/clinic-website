<?php

namespace Database\Factories;

use App\Models\Practitioner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Practitioner>
 */
class PractitionerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.fake()->unique()->randomNumber(4),
            'title' => 'Clinical Psychologist',
            'registration_number' => 'MAHPC(CP)'.fake()->randomNumber(4, true),
            'bio' => fake()->paragraph(),
            'specialties' => ['Anxiety', 'Depression'],
            'languages' => ['Bahasa Melayu', 'English'],
            'photo_path' => 'media/team/SKMED-PROFILE_02-1.png',
            'accepts_online' => true,
            'accepts_in_person' => true,
            'is_active' => true,
            'sort_order' => 1,
        ];
    }
}

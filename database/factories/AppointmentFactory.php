<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Practitioner;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_code' => 'SKM-'.strtoupper(Str::random(6)),
            'service_id' => Service::factory(),
            'practitioner_id' => Practitioner::factory(),
            'client_name' => fake()->name(),
            'client_email' => fake()->safeEmail(),
            'client_phone' => '01'.fake()->numerify('########'),
            'client_age' => fake()->numberBetween(18, 65),
            'reason_for_visit' => fake()->sentence(),
            'session_mode' => fake()->randomElement(['in_person', 'online']),
            'appointment_date' => date('Y-m-d', strtotime('+3 days')),
            'appointment_time' => '10:00 AM',
            'status' => 'pending',
            'total_amount' => 200.00,
            'deposit_amount' => 50.00,
            'payment_status' => 'pending',
            'payment_method' => 'fpx',
            'meeting_url' => null,
            'admin_notes' => null,
        ];
    }
}

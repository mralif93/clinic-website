<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Practitioner;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingProcessTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_submit_booking_and_redirect_to_confirmation(): void
    {
        $service = Service::factory()->create([
            'price' => 200.00,
            'deposit_amount' => 50.00,
            'is_active' => true,
        ]);

        $practitioner = Practitioner::factory()->create([
            'is_active' => true,
        ]);

        $response = $this->post(route('booking.store'), [
            'service_id' => $service->id,
            'practitioner_id' => $practitioner->id,
            'session_mode' => 'in_person',
            'appointment_date' => date('Y-m-d', strtotime('+3 days')),
            'appointment_time' => '10:00 AM',
            'client_name' => 'Ahmad Test',
            'client_email' => 'ahmad@test.com',
            'client_phone' => '0198765432',
            'client_age' => 30,
            'reason_for_visit' => 'Saya kerap berasa cemas di tempat kerja.',
        ]);

        $this->assertDatabaseHas('appointments', [
            'client_name' => 'Ahmad Test',
            'client_email' => 'ahmad@test.com',
            'service_id' => $service->id,
            'practitioner_id' => $practitioner->id,
        ]);

        $appointment = Appointment::first();
        $this->assertNotNull($appointment);

        $response->assertRedirect(route('booking.confirmation', ['booking_code' => $appointment->booking_code]));

        $confirmResponse = $this->get(route('booking.confirmation', ['booking_code' => $appointment->booking_code]));
        $confirmResponse->assertStatus(200);
        $confirmResponse->assertSee($appointment->booking_code);
        $confirmResponse->assertSee('Tempahan Berjaya Didaftarkan');
    }
}

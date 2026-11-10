<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\ScreenerResponse;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPortalTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Papan Pemuka Pentadbiran Klinik');
    }

    public function test_admin_can_view_appointments_and_update_status(): void
    {
        $service = Service::factory()->create();
        $appointment = Appointment::factory()->create([
            'service_id' => $service->id,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        $listResponse = $this->get(route('admin.appointments.index'));
        $listResponse->assertStatus(200);
        $listResponse->assertSee($appointment->booking_code);

        $showResponse = $this->get(route('admin.appointments.show', $appointment->id));
        $showResponse->assertStatus(200);
        $showResponse->assertSee($appointment->client_name);

        $updateResponse = $this->patch(route('admin.appointments.update-status', $appointment->id), [
            'status' => 'confirmed',
            'payment_status' => 'paid',
            'admin_notes' => 'Deposit disahkan masuk melalui akaun Maybank.',
            'meeting_url' => 'https://meet.google.com/abc-defg-hij',
        ]);

        $updateResponse->assertRedirect();
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'status' => 'confirmed',
            'payment_status' => 'paid',
            'admin_notes' => 'Deposit disahkan masuk melalui akaun Maybank.',
        ]);
    }

    public function test_admin_can_view_screeners(): void
    {
        $screener = ScreenerResponse::create([
            'screener_type' => 'dass21',
            'client_name' => 'Pesakit Ujian',
            'depression_score' => 14,
            'depression_severity' => 'Sederhana',
            'anxiety_score' => 8,
            'anxiety_severity' => 'Ringan',
            'stress_score' => 12,
            'stress_severity' => 'Normal',
            'answers' => [1 => 2, 2 => 1],
        ]);

        $listResponse = $this->get(route('admin.screeners.index'));
        $listResponse->assertStatus(200);
        $listResponse->assertSee('Pesakit Ujian');

        $showResponse = $this->get(route('admin.screeners.show', $screener->id));
        $showResponse->assertStatus(200);
        $showResponse->assertSee('Pesakit Ujian');
        $showResponse->assertSee('Pecahan Jawapan Klien');
    }
}

<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\ScreenerResponse;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminPortalTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin@sakeenahmedicare.net',
            'password' => Hash::make('password123'),
        ]);
    }

    public function test_unauthenticated_user_cannot_access_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_login_page_and_authenticate(): void
    {
        $viewResponse = $this->get(route('admin.login'));
        $viewResponse->assertStatus(200);
        $viewResponse->assertSee('Portal Pentadbiran Klinik');

        $loginResponse = $this->post(route('admin.login.submit'), [
            'email' => 'admin@sakeenahmedicare.net',
            'password' => 'password123',
        ]);

        $loginResponse->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($this->admin);
    }

    public function test_admin_can_view_dashboard_when_authenticated(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));

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

        $listResponse = $this->actingAs($this->admin)->get(route('admin.appointments.index'));
        $listResponse->assertStatus(200);
        $listResponse->assertSee($appointment->booking_code);

        $showResponse = $this->actingAs($this->admin)->get(route('admin.appointments.show', $appointment->id));
        $showResponse->assertStatus(200);
        $showResponse->assertSee($appointment->client_name);

        $updateResponse = $this->actingAs($this->admin)->patch(route('admin.appointments.update-status', $appointment->id), [
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

        $listResponse = $this->actingAs($this->admin)->get(route('admin.screeners.index'));
        $listResponse->assertStatus(200);
        $listResponse->assertSee('Pesakit Ujian');

        $showResponse = $this->actingAs($this->admin)->get(route('admin.screeners.show', $screener->id));
        $showResponse->assertStatus(200);
        $showResponse->assertSee('Pesakit Ujian');
        $showResponse->assertSee('Pecahan Jawapan Klien');
    }

    public function test_admin_can_logout(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }
}

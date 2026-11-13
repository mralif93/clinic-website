<?php

namespace Tests\Feature;

use App\Mail\AppointmentCreatedMail;
use App\Mail\AppointmentStatusUpdatedMail;
use App\Models\Appointment;
use App\Models\Practitioner;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BookingFlowComprehensiveTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_page_renders_with_services_and_practitioners(): void
    {
        $service = Service::factory()->create(['name' => 'Psikoterapi Individu', 'is_active' => true]);
        $practitioner = Practitioner::factory()->create(['name' => 'Dr. Aisyah', 'is_active' => true]);

        $response = $this->get(route('booking.index'));

        $response->assertOk();
        $response->assertSee('Psikoterapi Individu');
        $response->assertSee('Dr. Aisyah');
    }

    public function test_api_booked_slots_returns_unavailable_slots_and_schedule(): void
    {
        $practitioner = Practitioner::factory()->create([
            'working_days' => ['Tuesday', 'Wednesday'],
            'available_slots' => ['10:00 AM', '11:30 AM'],
        ]);
        $service = Service::factory()->create();

        // 2026-12-01 is a Tuesday
        Appointment::factory()->create([
            'service_id' => $service->id,
            'practitioner_id' => $practitioner->id,
            'appointment_date' => '2026-12-01',
            'appointment_time' => '10:00 AM',
            'status' => 'confirmed',
        ]);

        $response = $this->getJson(route('booking.booked-slots', [
            'date' => '2026-12-01',
            'practitioner_id' => $practitioner->id,
        ]));

        $response->assertOk();
        $response->assertJsonFragment(['10:00 AM']);
        $response->assertJson([
            'is_working_day' => true,
            'allowed_slots' => ['10:00 AM', '11:30 AM'],
        ]);
    }

    public function test_client_cannot_book_when_practitioner_is_on_leave(): void
    {
        $practitioner = Practitioner::factory()->create([
            'working_days' => ['Tuesday'],
            'available_slots' => ['10:00 AM'],
            'blocked_dates' => ['2026-12-01'], // 2026-12-01 is a Tuesday
        ]);
        $service = Service::factory()->create();

        $response = $this->from(route('booking.index'))->post(route('booking.store'), [
            'service_id' => $service->id,
            'practitioner_id' => $practitioner->id,
            'session_mode' => 'in_person',
            'appointment_date' => '2026-12-01',
            'appointment_time' => '10:00 AM',
            'client_name' => 'Ahmad Test',
            'client_email' => 'ahmad@example.com',
            'client_phone' => '0123456789',
        ]);

        $response->assertSessionHasErrors('appointment_date');
    }

    public function test_client_cannot_book_when_practitioner_is_not_working_on_that_day(): void
    {
        // 2026-12-01 is Tuesday, set practitioner to work only on Friday
        $practitioner = Practitioner::factory()->create([
            'working_days' => ['Friday'],
            'available_slots' => ['10:00 AM'],
        ]);
        $service = Service::factory()->create();

        $response = $this->from(route('booking.index'))->post(route('booking.store'), [
            'service_id' => $service->id,
            'practitioner_id' => $practitioner->id,
            'session_mode' => 'in_person',
            'appointment_date' => '2026-12-01',
            'appointment_time' => '10:00 AM',
            'client_name' => 'Ahmad Test',
            'client_email' => 'ahmad@example.com',
            'client_phone' => '0123456789',
        ]);

        $response->assertSessionHasErrors('appointment_date');
    }

    public function test_client_cannot_book_already_taken_slot_for_same_practitioner(): void
    {
        $practitioner = Practitioner::factory()->create([
            'working_days' => ['Tuesday'],
            'available_slots' => ['10:00 AM'],
        ]);
        $service = Service::factory()->create();

        // 2026-12-01 is Tuesday
        Appointment::factory()->create([
            'service_id' => $service->id,
            'practitioner_id' => $practitioner->id,
            'appointment_date' => '2026-12-01',
            'appointment_time' => '10:00 AM',
            'status' => 'pending',
        ]);

        $response = $this->from(route('booking.index'))->post(route('booking.store'), [
            'service_id' => $service->id,
            'practitioner_id' => $practitioner->id,
            'session_mode' => 'in_person',
            'appointment_date' => '2026-12-01',
            'appointment_time' => '10:00 AM',
            'client_name' => 'Ahmad Test',
            'client_email' => 'ahmad@example.com',
            'client_phone' => '0123456789',
        ]);

        $response->assertSessionHasErrors('appointment_time');
    }

    public function test_successful_booking_dispatches_email_and_redirects_to_confirmation(): void
    {
        Mail::fake();

        // 2026-12-04 is Friday
        $practitioner = Practitioner::factory()->create([
            'working_days' => ['Friday'],
            'available_slots' => ['02:00 PM'],
        ]);
        $service = Service::factory()->create(['price' => 200, 'deposit_amount' => 50]);

        $response = $this->post(route('booking.store'), [
            'service_id' => $service->id,
            'practitioner_id' => $practitioner->id,
            'session_mode' => 'in_person',
            'appointment_date' => '2026-12-04',
            'appointment_time' => '02:00 PM',
            'client_name' => 'Nurul Huda',
            'client_email' => 'nurul@example.com',
            'client_phone' => '0198765432',
        ]);

        $appointment = Appointment::where('client_email', 'nurul@example.com')->first();
        $this->assertNotNull($appointment);
        $this->assertEquals('pending', $appointment->status);

        $response->assertRedirect(route('booking.confirmation', ['booking_code' => $appointment->booking_code]));

        Mail::assertSent(AppointmentCreatedMail::class, function ($mail) use ($appointment) {
            return $mail->hasTo('nurul@example.com') && $mail->appointment->id === $appointment->id;
        });
    }

    public function test_client_can_upload_deposit_receipt_on_confirmation_page(): void
    {
        Storage::fake('public');

        $service = Service::factory()->create();
        $appointment = Appointment::factory()->create([
            'service_id' => $service->id,
            'deposit_receipt' => null,
        ]);

        $fakeReceipt = UploadedFile::fake()->create('slip_bayaran.pdf', 500, 'application/pdf');

        $response = $this->post(route('booking.upload-receipt', $appointment->booking_code), [
            'receipt' => $fakeReceipt,
        ]);

        $response->assertRedirect(route('booking.confirmation', $appointment->booking_code));
        $response->assertSessionHas('status');

        $appointment->refresh();
        $this->assertNotNull($appointment->deposit_receipt);
        Storage::disk('public')->assertExists($appointment->deposit_receipt);
    }

    public function test_admin_updating_appointment_status_dispatches_status_updated_email(): void
    {
        Mail::fake();

        $admin = User::factory()->create();
        $service = Service::factory()->create();
        $appointment = Appointment::factory()->create([
            'service_id' => $service->id,
            'client_email' => 'pesakit@example.com',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($admin)->patch(route('admin.appointments.update-status', $appointment->id), [
            'status' => 'confirmed',
            'payment_status' => 'paid',
            'admin_notes' => 'Slot disahkan oleh kaunselor bertugas.',
            'meeting_url' => 'https://meet.google.com/abc-defg-hij',
        ]);

        $response->assertRedirect(route('admin.appointments.show', $appointment->id));

        $appointment->refresh();
        $this->assertEquals('confirmed', $appointment->status);
        $this->assertEquals('paid', $appointment->payment_status);

        Mail::assertSent(AppointmentStatusUpdatedMail::class, function ($mail) {
            return $mail->hasTo('pesakit@example.com');
        });
    }
}

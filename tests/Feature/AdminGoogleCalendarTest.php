<?php

namespace Tests\Feature;

use App\Models\GoogleCalendarEvent;
use App\Models\User;
use App\Services\GoogleCalendarSyncService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AdminGoogleCalendarTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_google_calendar_page(): void
    {
        $response = $this->get(route('admin.google-calendar.index'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_admin_can_view_google_calendar_page(): void
    {
        $admin = User::factory()->create();

        GoogleCalendarEvent::create([
            'google_event_id' => 'sample-uid-123',
            'summary' => 'Sesi Terapi Klien Ahmad',
            'description' => 'Sesi kaunseling individu',
            'location' => 'Bilik Terapi 1',
            'start_time' => Carbon::now()->addDays(2),
            'end_time' => Carbon::now()->addDays(2)->addHour(),
            'is_all_day' => false,
            'status' => 'confirmed',
            'organizer_email' => 'admin@sakeenahmedicare.com',
            'attendees' => ['ahmad@example.com'],
            'last_synced_at' => Carbon::now(),
        ]);

        $response = $this->actingAs($admin)->get(route('admin.google-calendar.index'));

        $response->assertOk();
        $response->assertSee('Senarai Temujanji Google Calendar');
        $response->assertSee('Sesi Terapi Klien Ahmad');
        $response->assertSee('Bilik Terapi 1');
    }

    public function test_authenticated_admin_can_view_google_calendar_details_page(): void
    {
        $admin = User::factory()->create();

        $event = GoogleCalendarEvent::create([
            'google_event_id' => 'sample-uid-details-test',
            'summary' => 'Sesi Penilaian Diagnostik Penuh',
            'description' => 'Ujian terperinci psikologi klinikal bersama Dr Faiz',
            'location' => 'https://meet.google.com/test-meet-link',
            'start_time' => Carbon::now()->addDays(3),
            'end_time' => Carbon::now()->addDays(3)->addHours(2),
            'is_all_day' => false,
            'status' => 'confirmed',
            'html_link' => 'https://calendar.google.com/calendar/event?eid=test',
            'organizer_email' => 'admin@sakeenahmedicare.com',
            'attendees' => ['pesakit@example.com', 'pakar@example.com'],
            'last_synced_at' => Carbon::now(),
        ]);

        $response = $this->actingAs($admin)->get(route('admin.google-calendar.show', $event->id));

        $response->assertOk();
        $response->assertSee('Perincian Temujanji Google Calendar');
        $response->assertSee('Sesi Penilaian Diagnostik Penuh');
        $response->assertSee('https://meet.google.com/test-meet-link');
        $response->assertSee('pesakit@example.com');
        $response->assertSee('pakar@example.com');
    }

    public function test_filter_by_single_date(): void
    {
        $admin = User::factory()->create();

        GoogleCalendarEvent::create([
            'google_event_id' => 'evt-date-1',
            'summary' => 'Temujanji Tarikh Tepat',
            'start_time' => Carbon::parse('2026-11-20 10:00:00'),
            'status' => 'confirmed',
        ]);

        GoogleCalendarEvent::create([
            'google_event_id' => 'evt-date-2',
            'summary' => 'Temujanji Tarikh Lain',
            'start_time' => Carbon::parse('2026-11-22 10:00:00'),
            'status' => 'confirmed',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.google-calendar.index', ['date' => '2026-11-20']));

        $response->assertOk();
        $response->assertSee('Temujanji Tarikh Tepat');
        $response->assertDontSee('Temujanji Tarikh Lain');
    }

    public function test_filter_by_date_range(): void
    {
        $admin = User::factory()->create();

        GoogleCalendarEvent::create([
            'google_event_id' => 'evt-range-in',
            'summary' => 'Temujanji Dalam Julat',
            'start_time' => Carbon::parse('2026-11-25 14:00:00'),
            'status' => 'confirmed',
        ]);

        GoogleCalendarEvent::create([
            'google_event_id' => 'evt-range-out',
            'summary' => 'Temujanji Luar Julat',
            'start_time' => Carbon::parse('2026-12-10 14:00:00'),
            'status' => 'confirmed',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.google-calendar.index', [
            'start_date' => '2026-11-24',
            'end_date' => '2026-11-26',
        ]));

        $response->assertOk();
        $response->assertSee('Temujanji Dalam Julat');
        $response->assertDontSee('Temujanji Luar Julat');
    }

    public function test_sync_service_parses_ics_and_stores_events(): void
    {
        $fakeIcs = <<<'ICS'
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Google Inc//Google Calendar 70.9054//EN
BEGIN:VEVENT
UID:gcal-event-999@google.com
SUMMARY:Penilaian Psikologi Adik Danial
DESCRIPTION:Ujian ADHD & Autism bersama Pn Siti
LOCATION:https://meet.google.com/xyz-abcd-efg
DTSTART:20261120T100000Z
DTEND:20261120T110000Z
STATUS:CONFIRMED
ORGANIZER:mailto:klinik@sakeenahmedicare.com
ATTENDEE:mailto:ibu.danial@example.com
END:VEVENT
END:VCALENDAR
ICS;

        Http::fake([
            'https://calendar.google.com/*' => Http::response($fakeIcs, 200),
        ]);

        config(['services.google_calendar.ical_url' => 'https://calendar.google.com/calendar/ical/test/basic.ics']);

        $service = new GoogleCalendarSyncService;
        $result = $service->sync();

        $this->assertTrue($result['success']);
        $this->assertEquals(1, $result['count']);

        $this->assertDatabaseHas('google_calendar_events', [
            'google_event_id' => 'gcal-event-999@google.com',
            'summary' => 'Penilaian Psikologi Adik Danial',
            'location' => 'https://meet.google.com/xyz-abcd-efg',
        ]);
    }

    public function test_manual_sync_trigger_via_controller(): void
    {
        $admin = User::factory()->create();

        $fakeIcs = <<<'ICS'
BEGIN:VCALENDAR
VERSION:2.0
BEGIN:VEVENT
UID:manual-sync-111
SUMMARY:Konsultasi Online Dr Faiz
DTSTART:20261125T090000Z
DTEND:20261125T100000Z
END:VEVENT
END:VCALENDAR
ICS;

        Http::fake([
            'https://calendar.google.com/*' => Http::response($fakeIcs, 200),
        ]);

        config(['services.google_calendar.ical_url' => 'https://calendar.google.com/calendar/ical/test/basic.ics']);

        $response = $this->actingAs($admin)->post(route('admin.google-calendar.sync'));

        $response->assertRedirect(route('admin.google-calendar.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('google_calendar_events', [
            'google_event_id' => 'manual-sync-111',
            'summary' => 'Konsultasi Online Dr Faiz',
        ]);
    }

    public function test_artisan_sync_command_runs_successfully(): void
    {
        $fakeIcs = <<<'ICS'
BEGIN:VCALENDAR
VERSION:2.0
BEGIN:VEVENT
UID:artisan-sync-222
SUMMARY:Sesi Terapi Pasangan
DTSTART:20261130T040000Z
DTEND:20261130T050000Z
END:VEVENT
END:VCALENDAR
ICS;

        Http::fake([
            'https://calendar.google.com/*' => Http::response($fakeIcs, 200),
        ]);

        config(['services.google_calendar.ical_url' => 'https://calendar.google.com/calendar/ical/test/basic.ics']);

        $this->artisan('google-calendar:sync')
            ->expectsOutputToContain('Berjaya menyegerakkan')
            ->assertExitCode(0);

        $this->assertDatabaseHas('google_calendar_events', [
            'google_event_id' => 'artisan-sync-222',
            'summary' => 'Sesi Terapi Pasangan',
        ]);
    }
}

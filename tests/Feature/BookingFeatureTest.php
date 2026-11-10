<?php

namespace Tests\Feature;

use App\Models\Practitioner;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_page_renders_successfully(): void
    {
        Service::factory()->create(['is_active' => true]);
        Practitioner::factory()->create(['is_active' => true]);

        $response = $this->get(route('booking.index'));

        $response->assertStatus(200);
        $response->assertSee('Tempah Sesi Temu Janji');
    }
}

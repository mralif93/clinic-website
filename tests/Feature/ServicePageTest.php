<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServicePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_services_index_and_detail(): void
    {
        $service = Service::factory()->create([
            'name' => 'Terapi Ujian Minda',
            'slug' => 'terapi-ujian-minda',
            'is_active' => true,
        ]);

        $indexResponse = $this->get(route('services.index'));
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Terapi Ujian Minda');

        $detailResponse = $this->get(route('services.show', $service->slug));
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee('Terapi Ujian Minda');
    }
}

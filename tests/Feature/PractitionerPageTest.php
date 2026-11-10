<?php

namespace Tests\Feature;

use App\Models\Practitioner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PractitionerPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_practitioners_index_and_detail(): void
    {
        $practitioner = Practitioner::factory()->create([
            'name' => 'CP Dr Sarah Test',
            'slug' => 'cp-dr-sarah-test',
            'is_active' => true,
        ]);

        $indexResponse = $this->get(route('practitioners.index'));
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('CP Dr Sarah Test');

        $detailResponse = $this->get(route('practitioners.show', $practitioner->slug));
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee('CP Dr Sarah Test');
    }
}

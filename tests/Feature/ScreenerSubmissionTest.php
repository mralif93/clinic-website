<?php

namespace Tests\Feature;

use App\Models\ScreenerResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScreenerSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_submit_dass21_and_view_results(): void
    {
        // 21 answers
        $answers = [];
        for ($i = 1; $i <= 21; $i++) {
            $answers[$i] = 2; // moderate
        }

        $response = $this->post(route('screener.store'), [
            'client_name' => 'Alif Test',
            'client_email' => 'alif@test.com',
            'client_phone' => '0123456789',
            'q' => $answers,
        ]);

        $this->assertDatabaseHas('screener_responses', [
            'client_name' => 'Alif Test',
            'screener_type' => 'dass21',
        ]);

        $screener = ScreenerResponse::first();
        $this->assertNotNull($screener);

        $response->assertRedirect(route('screener.result', ['id' => $screener->id]));

        $resultResponse = $this->get(route('screener.result', ['id' => $screener->id]));
        $resultResponse->assertStatus(200);
        $resultResponse->assertSee('Status Emosi');
        $resultResponse->assertSee('Kemurungan (Depression)');
    }
}

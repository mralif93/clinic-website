<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScreenerFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_screener_page_renders_successfully(): void
    {
        $response = $this->get(route('screener.index'));

        $response->assertStatus(200);
        $response->assertSee('Ujian Saringan DASS-21');
    }
}

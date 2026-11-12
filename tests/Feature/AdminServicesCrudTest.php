<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminServicesCrudTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin@sakeenahmedicare.net',
        ]);
    }

    public function test_admin_can_view_services_index(): void
    {
        Service::factory()->create(['name' => 'Ujian Diagnostik Minda']);

        $response = $this->actingAs($this->admin)->get(route('admin.services.index'));

        $response->assertStatus(200);
        $response->assertSee('Katalog Perkhidmatan dan Sesi Terapi');
        $response->assertSee('Ujian Diagnostik Minda');
    }

    public function test_admin_can_view_create_service_form(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.services.create'));

        $response->assertStatus(200);
        $response->assertSee('Tambah Perkhidmatan Terapi');
    }

    public function test_admin_can_store_new_service_with_uploaded_image(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('banner.jpg');

        $payload = [
            'name' => 'Psikoterapi Kanak-Kanak',
            'category' => 'child_therapy',
            'target_audience' => 'Kanak-kanak umur 5-12 tahun',
            'summary' => 'Sesi bimbingan emosi untuk kanak-kanak.',
            'description' => 'Penerangan komprehensif mengenai terapi bermain.',
            'price' => 180.00,
            'deposit_amount' => 50.00,
            'duration_minutes' => 60,
            'image' => $file,
            'allows_online' => 1,
            'allows_in_person' => 1,
            'is_featured' => 1,
            'is_active' => 1,
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.services.store'), $payload);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'name' => 'Psikoterapi Kanak-Kanak',
            'category' => 'child_therapy',
        ]);

        $service = Service::where('name', 'Psikoterapi Kanak-Kanak')->first();
        $this->assertNotNull($service->image_path);
        Storage::disk('public')->assertExists(str_replace('storage/', '', $service->image_path));
    }

    public function test_admin_can_update_service(): void
    {
        $service = Service::factory()->create(['name' => 'Servis Asal', 'price' => 150]);

        $payload = [
            'name' => 'Servis Dikemaskini',
            'category' => 'psychotherapy',
            'target_audience' => 'Dewasa',
            'summary' => 'Ringkasan baharu',
            'description' => 'Penerangan baharu',
            'price' => 220.00,
            'deposit_amount' => 60.00,
            'duration_minutes' => 75,
            'allows_online' => 1,
            'allows_in_person' => 1,
            'is_featured' => 0,
            'is_active' => 1,
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.services.update', $service->id), $payload);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'name' => 'Servis Dikemaskini',
            'price' => 220.00,
        ]);
    }

    public function test_admin_can_delete_service(): void
    {
        $service = Service::factory()->create(['name' => 'Servis Dipadam']);

        $response = $this->actingAs($this->admin)->delete(route('admin.services.destroy', $service->id));

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseMissing('services', [
            'id' => $service->id,
        ]);
    }
}

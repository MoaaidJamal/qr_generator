<?php

namespace Tests\Feature;

use App\Models\Qr;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Tests\TestCase;

class GenerateQRTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_generate_qr_page_is_displayed()
    {
        $data = [
            'content' => 'test',
            'size' => 100,
            'background_color' => '#ffffff',
            'fill_color' => '#000000',
        ];
        $response = $this->postJson('/qr-generate', $data);

        $this->assertDatabaseHas('qrs', array_merge($data, ['user_id' => $this->user->id]));
        $qr = Qr::query()->first();
        $this->assertFileExists(Storage::path($qr->path));
        $response->assertRedirect('/dashboard');
    }

    public function test_validate_content_is_required()
    {
        $response = $this->postJson('/qr-generate', [
            'size' => 100,
            'background_color' => '#ffffff',
            'fill_color' => '#000000',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['content']);
    }

    public function test_validate_size_is_required()
    {
        $response = $this->postJson('/qr-generate', [
            'content' => 'test',
            'background_color' => '#ffffff',
            'fill_color' => '#000000',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['size']);
    }

    public function test_validate_size_is_integer()
    {
        $response = $this->postJson('/qr-generate', [
            'content' => 'test',
            'size' => 'invalid integer',
            'background_color' => '#ffffff',
            'fill_color' => '#000000',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['size']);
    }

    public function test_validate_background_color_is_required()
    {
        $response = $this->postJson('/qr-generate', [
            'content' => 'test',
            'size' => 100,
            'fill_color' => '#000000',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['background_color']);
    }

    public function test_validate_fill_color_is_required()
    {
        $response = $this->postJson('/qr-generate', [
            'content' => 'test',
            'size' => 100,
            'background_color' => '#ffffff',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['fill_color']);
    }
}

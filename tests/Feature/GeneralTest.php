<?php

namespace Tests\Feature;

use App\Models\General;
use Database\Seeders\GeneralTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GeneralTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testGetGeneralSettings()
    {
        $response = $this->getJson('/api/general-settings');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'logo_url',
            'logo_local_path',
            'home_page_text',
            'email',
            'phone',
            'address',
            'created_at',
            'updated_at',
        ]);
    }

    public function testCreateGeneralSettings()
    {
        $file = UploadedFile::fake()->image('avatar.jpg');

        $homePageText  = 'test';
        $email         = 'test1@test.com';
        $phone         = '0000000000';
        $address       = 'test';

        $response = $this->postJson('/api/general-settings', [
            'logo'            => $file,
            'home_page_text'  => $homePageText,
            'email'           => $email,
            'phone'           => $phone,
            'address'         => $address,
        ], ['Accept'          => 'application/json']);

        $response->assertStatus(200);

        $general = General::first();

        Storage::disk('public')->assertExists($file->hashName());
        $this->assertSame($general->id, 1);
        $this->assertSame($general->home_page_text, $homePageText);
        $this->assertSame($general->email, $email);
        $this->assertSame($general->phone, $phone);
        $this->assertSame($general->address, $address);
    }
}

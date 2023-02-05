<?php

namespace Tests\Feature;

use App\Models\Challenge;
use Database\Seeders\ChallengeTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChallengeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(ChallengeTableSeeder::class);
    }

    public function testGetChallenge()
    {
        $response = $this->getJson('/api/challenges');

        $response->assertStatus(200);
        $response->assertJsonStructure([[
            'id',
            'name',
            'created_at',
            'updated_at',
        ]]);
    }

    public function testGetOneChallenge()
    {
        $response = $this->getJson('/api/challenges/1');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'created_at',
            'updated_at',
        ]);
    }

    public function testCreateChallenge()
    {
        $challengeName  = 'New Name';

        $response = $this->postJson('/api/challenges', [
            'name'   => $challengeName,
        ]);

        $response->assertStatus(200);

        $project = Challenge::find(2);

        $this->assertSame($project->id, 2);
        $this->assertSame($project->name, $challengeName);
    }

    public function testUpdateChallenge()
    {
        $challengeId    = 1;
        $challengeName  = 'New Name';

        $response = $this->putJson('/api/challenges/' . $challengeId, [
            'name'   => $challengeName,
        ]);

        $response->assertStatus(200);

        $project = Challenge::find($challengeId);

        $this->assertSame($project->name, $challengeName);
    }
}

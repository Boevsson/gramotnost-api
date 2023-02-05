<?php

namespace Tests\Feature;

use App\Models\Subsection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubsectionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testGetSubsections()
    {
        $response = $this->getJson('/api/subsections');

        $response->assertStatus(200);
        $response->assertJsonStructure([[
            'id',
            'name',
            'color',
            'challenge_id',
            'created_at',
            'updated_at',
        ]]);
    }

    public function testGetOneSubsection()
    {
        $response = $this->getJson('/api/subsections/1');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'color',
            'challenge_id',
            'created_at',
            'updated_at',
        ]);
    }

    public function testCreateSubsection()
    {
        $subsectionName        = 'New Name';
        $subsectionColor       = 'New Color';
        $subsectionChallengeId = 1;

        $response = $this->postJson('/api/subsections', [
            'name'         => $subsectionName,
            'color'        => $subsectionColor,
            'challenge_id' => $subsectionChallengeId,
        ]);

        $response->assertStatus(200);

        $subsection = Subsection::find(2);

        $this->assertSame($subsection->id, 2);
        $this->assertSame($subsection->name, $subsectionName);
        $this->assertSame($subsection->color, $subsectionColor);
        $this->assertSame($subsection->challenge_id, $subsectionChallengeId);
    }

    public function testUpdateSubsection()
    {
        $subsectionId          = 1;
        $subsectionName        = 'New Name';
        $subsectionColor       = 'New Color';
        $subsectionChallengeId = 1;

        $response = $this->putJson('/api/subsections/' . $subsectionId, [
            'name'         => $subsectionName,
            'color'        => $subsectionColor,
            'challenge_id' => $subsectionChallengeId,
        ]);

        $response->assertStatus(200);

        $subsection = Subsection::find($subsectionId);

        $this->assertSame($subsection->name, $subsectionName);
        $this->assertSame($subsection->color, $subsectionColor);
        $this->assertSame($subsection->challenge_id, $subsectionChallengeId);
    }
}

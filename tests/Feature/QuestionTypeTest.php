<?php

namespace Tests\Feature;

use App\Models\QuestionType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionTypeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();

    }

    public function testGetQuestionTypes()
    {
        $response = $this->getJson('/api/question-types');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            [
                'id',
                'name',
            ]
        ]);
    }

    public function testGetOneQuestionType()
    {
        $response = $this->getJson('/api/question-types/1');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
        ]);
    }

    public function testCreateQuestionType()
    {
        $name = 'Drag and drop';

        $response = $this->postJson('/api/question-types', [
            'name' => $name,
        ]);

        $response->assertStatus(200);

        $questionType = QuestionType::find(2);

        $this->assertSame($questionType->id, 2);
        $this->assertSame($questionType->name, $name);
    }

    public function testUpdateQuestionType()
    {
        $id = 1;
        $name = 'New Name';

        $response = $this->putJson('/api/question-types/' . $id, [
            'name' => $name,
        ]);

        $response->assertStatus(200);

        $questionType = QuestionType::find($id);

        $this->assertSame($questionType->name, $name);
    }
}

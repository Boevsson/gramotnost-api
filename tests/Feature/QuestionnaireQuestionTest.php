<?php

namespace Tests\Feature;

use App\Models\QuestionnaireQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionnaireQuestionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();

    }

    public function testGetQuestionnaireQuestions()
    {
        $response = $this->getJson('/api/questionnaire-questions');

        $response->assertStatus(200);
        $response->assertJsonStructure([[
            'id',
            'question_text',
            'answer_text',
            'color',
            'created_at',
            'updated_at',
        ]]);
    }

    public function testGetOneQuestionnaireQuestion()
    {
        $response = $this->getJson('/api/questionnaire-questions/1');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'question_text',
            'answer_text',
            'color',
            'created_at',
            'updated_at',
        ]);    }

    public function testCreateQuestionnaireQuestion()
    {
        $questionText = 'Test';
        $answerText   = 'Test';
        $color        = 'Test color';

        $response = $this->postJson('/api/questionnaire-questions', [
            'question_text' => $questionText,
            'answer_text'   => $answerText,
            'color'         => $color,
        ]);

        $response->assertStatus(200);

        $questionnaireQuestion = QuestionnaireQuestion::find(2);

        $this->assertSame($questionnaireQuestion->id, 2);
        $this->assertSame($questionnaireQuestion->question_text, $questionText);
        $this->assertSame($questionnaireQuestion->answer_text, $answerText);
        $this->assertSame($questionnaireQuestion->color, $color);
    }

    public function testUpdateQuestionnaireQuestion()
    {
        $id           = 1;
        $questionText = 'Test2';
        $answerText   = 'Test2';
        $color        = 'Test2';

        $response = $this->putJson('/api/questionnaire-questions/' . $id, [
            'question_text' => $questionText,
            'answer_text'   => $answerText,
            'color'         => $color,
        ]);

        $response->assertStatus(200);

        $questionnaireQuestion = QuestionnaireQuestion::find($id);

        $this->assertSame($questionnaireQuestion->question_text, $questionText);
        $this->assertSame($questionnaireQuestion->answer_text, $answerText);
        $this->assertSame($questionnaireQuestion->color, $color);
    }
}

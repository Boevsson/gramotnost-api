<?php

namespace Tests\Feature;

use App\Models\Answer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnswerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testGetAnswers()
    {
        $response = $this->getJson('/api/answers');

        $response->assertStatus(200);
        $response->assertJsonStructure([[
                                            'id',
                                            'text',
                                            'correct_answer',
                                            'position',
                                            'question_id',
                                            'created_at',
                                            'updated_at',]]);
    }

    public function testGetOneAnswer()
    {
        $response = $this->getJson('/api/answers/1');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'text',
            'correct_answer',
            'position',
            'question_id',
            'created_at',
            'updated_at',]);
    }

    public function testCreateAnswer()
    {
        $text = 'test';
        $isCorrectAnswer = 1;
        $questionId = 1;
        $correctAnswer = 'test';
        $position = 1;

        $response = $this->postJson('/api/answers', [
            'text'              => $text,
            'correct_answer'    => $correctAnswer,
            'position'          => $position,
            'is_correct_answer' => $isCorrectAnswer,
            'question_id'       => $questionId,
        ]);

        $response->assertStatus(200);

        $answer = Answer::find(2);

        $this->assertSame($answer->id, 2);
        $this->assertSame($answer->text, $text);
        $this->assertSame($answer->correct_answer, $correctAnswer);
        $this->assertSame($answer->position, $position);
        $this->assertSame($answer->is_correct_answer, $isCorrectAnswer);
        $this->assertSame($answer->question_id, $questionId);
    }

    public function testUpdateAnswer()
    {
        $projectId = 1;
        $text = 'test';
        $isCorrectAnswer = 1;
        $questionId = 1;
        $correctAnswer = 'test';
        $position = 1;

        $response = $this->putJson('/api/answers/' . $projectId, [
            'text'              => $text,
            'correct_answer'    => $correctAnswer,
            'position'          => $position,
            'is_correct_answer' => $isCorrectAnswer,
            'question_id'       => $questionId,
        ]);

        $response->assertStatus(200);

        $answer = Answer::find($projectId);

        $this->assertSame($answer->text, $text);
        $this->assertSame($answer->correct_answer, $correctAnswer);
        $this->assertSame($answer->position, $position);
        $this->assertSame($answer->is_correct_answer, $isCorrectAnswer);
        $this->assertSame($answer->question_id, $questionId);
    }
}

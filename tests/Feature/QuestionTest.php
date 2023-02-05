<?php

namespace Tests\Feature;

use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

//    public function testGetQuestions()
//    {
//        $response = $this->getJson('/api/questions');
//
//        $response->assertStatus(200);
//        $response->assertJsonStructure([[
//                                            'id',
//                                            'question',
//                                            'text',
//                                            'type_id',
//                                            'category_id',
//                                            'created_at',
//                                            'updated_at',
//                                        ]]);
//    }
//
//    public function testGetOneQuestion()
//    {
//        $response = $this->getJson('/api/questions/1');
//
//        $response->assertStatus(200);
//        $response->assertJsonStructure([
//            'id',
//            'question',
//            'text',
//            'type_id',
//            'category_id',
//            'created_at',
//            'updated_at',]);
//    }

    public function testCreateQuestion()
    {
        $questionText = 'testttt';
        $text = 'test';
        $siteText = 'test';
        $typeId = 1;
        $categoryId = 1;
        $answers = '[
                     {"text":"test","is_correct_answer":1,"correct_answer":"1","position":1},
                     {"text":"test2","is_correct_answer":0,"correct_answer":"1","position":1}
        ]';

        $response = $this->postJson('/api/questions', [
            'question'    => $questionText,
            'text'        => $text,
            'side_text'   => $siteText,
            'type_id'     => $typeId,
            'category_id' => $categoryId,
            'answers'     => $answers,
        ]);

        $response->assertStatus(200);

        $question = Question::find(2);

        $this->assertSame($question->id, 2);
        $this->assertSame($question->question, $questionText);
        $this->assertSame($question->text, $text);
        $this->assertSame($question->side_text, $siteText);
        $this->assertSame($question->type_id, $typeId);
        $this->assertSame($question->category_id, $categoryId);
        $inputAnswers = json_decode($answers);

        foreach ($question->answers as $index => $data) {

            $inputAnswer = $inputAnswers[$index];

            $this->assertSame($data->text, $inputAnswer->text);
            $this->assertSame($data->is_correct_answer, $inputAnswer->is_correct_answer);
            $this->assertSame($data->question_id, $question->id);
            $this->assertSame($data->correct_answer, $inputAnswer->correct_answer);
            $this->assertSame($data->position, $inputAnswer->position);
        }
    }

//    public function testUpdateQuestion()
//    {
//        $id = 1;
//        $text = 'test';
//        $question = 'test';
//        $typeId = 1;
//        $categoryId = 1;
//
//        $response = $this->putJson('/api/questions/' . $id, [
//            'question'    => $question,
//            'text'        => $text,
//            'type_id'     => $typeId,
//            'category_id' => $categoryId,
//        ]);
//
//        $response->assertStatus(200);
//
//        $question = Question::find($id);
//
//        $this->assertSame($question->question, $question);
//        $this->assertSame($question->text, $text);
//        $this->assertSame($question->type_id, $typeId);
//        $this->assertSame($question->category_id, $categoryId);
//    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function getAll(Request $request)
    {
        $answers = Answer::get();

        return response()->json($answers);
    }

    public function getOne(Request $request, $answerId)
    {
        $answers = Answer::findOrFail($answerId);

        return response()->json($answers);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'text'              => ['required'],
            'correct_answer'    => ['required'],
            'position'          => ['required'],
            'is_correct_answer' => ['required'],
            'question_id'       => ['required'],
        ]);

        $project = Answer::create([
            'text'              => $fields['text'],
            'correct_answer'    => $fields['correct_answer'],
            'position'          => $fields['position'],
            'is_correct_answer' => $fields['is_correct_answer'],
            'question_id'       => $fields['question_id'],
        ]);

        return response()->json($project);
    }

    public function update(Request $request, $answerId)
    {
        $fields = $request->validate([
            'text'              => ['required'],
            'correct_answer'    => ['required'],
            'position'          => ['required'],
            'is_correct_answer' => ['required'],
            'question_id'       => ['required'],
        ]);

        $answer = Answer::findOrFail($answerId);
        $answer->text              = $fields['text'];
        $answer->correct_answer    = $fields['correct_answer'];
        $answer->position          = $fields['position'];
        $answer->is_correct_answer = $fields['is_correct_answer'];
        $answer->question_id       = $fields['question_id'];
        $answer->save();

        return response()->json($answer);
    }

    public function delete(Request $request, $projectId)
    {
        $answer = Answer::findOrFail($projectId);
        $answer->delete();

        return response()->noContent();
    }
}

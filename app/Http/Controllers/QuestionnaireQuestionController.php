<?php

namespace App\Http\Controllers;

use App\Models\QuestionnaireQuestion;
use Illuminate\Http\Request;

class QuestionnaireQuestionController extends Controller
{
    public function getAll(Request $request)
    {
        $questionnaireQuestions = QuestionnaireQuestion::get();

        return response()->json($questionnaireQuestions);
    }

    public function getOne(Request $request, $questionnaireQuestionId)
    {
        $questionnaireQuestion = QuestionnaireQuestion::findOrFail($questionnaireQuestionId);

        return response()->json($questionnaireQuestion);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'question_text' => ['required'],
            'answer_text'   => ['required'],
            'color'         => ['required'],
        ]);

        $questionnaireQuestion = QuestionnaireQuestion::create([
            'question_text' => $fields['question_text'],
            'answer_text'   => $fields['answer_text'],
            'color'         => $fields['color'],
        ]);

        return response()->json($questionnaireQuestion);
    }

    public function update(Request $request, $questionnaireQuestionId)
    {
        $fields = $request->validate([
            'question_text' => ['required'],
            'answer_text'   => ['required'],
            'color'         => ['required'],
        ]);

        $questionnaireQuestion                = QuestionnaireQuestion::findOrFail($questionnaireQuestionId);
        $questionnaireQuestion->question_text = $fields['question_text'];
        $questionnaireQuestion->answer_text   = $fields['answer_text'];
        $questionnaireQuestion->color         = $fields['color'];
        $questionnaireQuestion->save();

        return response()->json($questionnaireQuestion);
    }

    public function delete(Request $request, $questionnaireQuestionId)
    {
        $questionnaireQuestion = QuestionnaireQuestion::findOrFail($questionnaireQuestionId);
        $questionnaireQuestion->delete();

        return response()->noContent();
    }
}

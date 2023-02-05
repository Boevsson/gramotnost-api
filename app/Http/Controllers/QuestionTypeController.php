<?php

namespace App\Http\Controllers;

use App\Models\QuestionType;
use Illuminate\Http\Request;

class QuestionTypeController extends Controller
{
    public function getAll(Request $request)
    {
        $questionTypes = QuestionType::get();

        return response()->json($questionTypes);
    }

    public function getOne(Request $request, $questionTypeId)
    {
        $questionType = QuestionType::findOrFail($questionTypeId);

        return response()->json($questionType);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required'],
        ]);

        $questionType = QuestionType::create([
            'name' => $fields['name'],
        ]);

        return response()->json($questionType);
    }

    public function update(Request $request, $questionTypeId)
    {
        $fields = $request->validate([
            'name' => ['required'],
        ]);

        $questionType = QuestionType::findOrFail($questionTypeId);
        $questionType->name = $fields['name'];
        $questionType->save();

        return response()->json($questionType);
    }

    public function delete(Request $request, $questionTypeId)
    {
        $questionType = QuestionType::findOrFail($questionTypeId);
        $questionType->delete();

        return response()->noContent();
    }
}

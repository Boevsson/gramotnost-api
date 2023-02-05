<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\File;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public function getAll(Request $request)
    {
        $questions = Question::get();

        return response()->json($questions);
    }

    public function getOne(Request $request, $questionId)
    {
        $question = Question::with(['images', 'answers'])->findOrFail($questionId);

        return response()->json($question);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'question'          => ['required'],
            'text'              => ['required'],
            'type_id'           => ['required'],
            'category_id'       => ['required'],
            'answers'           => ['required'],
            'answers_to_delete' => ['string'],
        ]);

        $data = $request->all();

        $category               = Category::findOrFail($request->category_id);
        $categoryQuestionsCount = count($category->questions);

        $question = Question::create([
            'question'    => $data['question'],
            'text'        => $data['text'],
            'side_text'   => $data['side_text'] ?? null,
            'order'       => $categoryQuestionsCount++,
            'type_id'     => $data['type_id'],
            'category_id' => $data['category_id'],
        ]);

        $answers = json_decode($request->answers, true);

        foreach ($answers as $answerData) {

            $answer = new Answer();
            $answer->fill([
                'text'              => $answerData['text'],
                'correct_answer'    => $answerData['correct_answer'] ?? null,
                'position'          => $answerData['position'] ?? null,
                'is_correct_answer' => $answerData['is_correct_answer'],
                'question_id'       => $question->id,
            ]);
            $answer->save();
        }

        if ($uploadedFile = $request->file('image')) {

            $url  = url('/');
            $path = $uploadedFile->storePublicly('public');

            $file             = new File();
            $file->name       = $uploadedFile->hashName();
            $file->local_path = $path;
            $file->url        = "$url/storage/" . $uploadedFile->hashName();
            $file->save();

            $question->images()->attach($file->id);
        }

        return response()->json($question);
    }

    public function update(Request $request, $questionId)
    {
        $fields = $request->validate([
            'question'  => ['required'],
            'type_id'   => ['required'],
        ]);

        $data = $request->all();

        $question            = Question::findOrFail($questionId);
        $question->question  = $data['question'];
        $question->text      = $data['text'] ?? null;
        $question->side_text = $data['side_text'] ?? null;
        $question->type_id   = $data['type_id'];
        $question->save();

        $answers = json_decode($request->answers, true);

        foreach ($answers as $answerData) {

            $answer = new Answer();

            if (isset($answerData['id'])) {

                $answer = Answer::find($answerData['id']);
            }

            $answer->fill([
                'text'              => $answerData['text'],
                'correct_answer'    => $answerData['correct_answer'] ?? null,
                'position'          => $answerData['position'] ?? null,
                'is_correct_answer' => $answerData['is_correct_answer'],
                'question_id'       => $question->id,
            ]);
            $answer->save();
        }

        if ($request->has('answers_to_delete')) {

            $answersToDelete = json_decode($request->answers_to_delete, true);
            Answer::destroy($answersToDelete);
        }

        if ($uploadedFile = $request->file('image')) {

            $url  = url('/');
            $path = $uploadedFile->storePublicly('public');

            $file             = new File();
            $file->name       = $uploadedFile->hashName();
            $file->local_path = $path;
            $file->url        = "$url/storage/" . $uploadedFile->hashName();
            $file->save();

            //Delete old image file
            if (count($question->images) > 0) {

                File::destroy($question->images[0]->id);
                Storage::delete($question->images[0]->local_path);
            }

            $question->images()->attach($file->id);
        }

        $question = Question::with(['images', 'answers'])->findOrFail($question->id);

        return response()->json($question);
    }

    public function reorder(Request $request)
    {
        $questions = $request->questions;

        foreach ($questions as $index => $question) {

            $question        = Question::find($question['id']);
            $question->order = $index;
            $question->save();
        }
    }

    public function delete(Request $request, $questionId)
    {
        $question = Question::findOrFail($questionId);
        $question->delete();

        return response()->noContent();
    }
}

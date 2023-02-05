<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAll(Request $request)
    {
        $categories = Category::get();

        return response()->json($categories);
    }

    public function getOne(Request $request, $categoryId)
    {
        $category = Category::with('subsection')->findOrFail($categoryId);

        return response()->json($category);
    }

    public function getQuestions(Request $request, $categoryId)
    {
        $questions = Question::with(['answers', 'images'])->where('category_id', $categoryId)->orderBy('order', 'ASC')->get();

        return response()->json($questions);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name'          => ['required'],
            'color'         => ['required'],
            'subsection_id' => ['required'],
        ]);

        $category = Category::create([
            'name'          => $fields['name'],
            'color'         => $fields['color'],
            'subsection_id' => $fields['subsection_id'],
        ]);

        return response()->json($category);
    }

    public function update(Request $request, $categoryId)
    {
        $fields = $request->validate([
            'name'          => ['required'],
            'color'         => ['required'],
            'subsection_id' => ['required'],
        ]);

        $category = Category::findOrFail($categoryId);
        $category->name          = $fields['name'];
        $category->color         = $fields['color'];
        $category->subsection_id = $fields['subsection_id'];
        $category->save();

        return response()->json($category);
    }

    public function delete(Request $request, $categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->delete();

        return response()->noContent();
    }
}

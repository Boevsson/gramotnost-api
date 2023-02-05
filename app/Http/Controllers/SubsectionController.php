<?php

namespace App\Http\Controllers;

use App\Models\Subsection;
use Illuminate\Http\Request;

class SubsectionController extends Controller
{
    public function getAll(Request $request)
    {
        $subsections = Subsection::orderBy('challenge_id', 'asc')->get();

        return response()->json($subsections);
    }

    public function getOne(Request $request, $subsectionId)
    {
        $subsection = Subsection::findOrFail($subsectionId);

        return response()->json($subsection);
    }

    public function getCategories(Request $request, $subsectionId)
    {
        $subsection = Subsection::findOrFail($subsectionId);

        return response()->json($subsection->categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => ['required'],
            'color'        => ['required'],
            'challenge_id' => ['required'],
        ]);

        $fields = $request->all();

        $subsection = Subsection::create([
            'name'         => $fields['name'],
            'color'        => $fields['color'],
            'video_link'   => $fields['video_link'] ?? null,
            'challenge_id' => $fields['challenge_id'],
        ]);

        return response()->json($subsection);
    }

    public function update(Request $request, $subsectionId)
    {
        $request->validate([
            'name'         => ['required'],
            'color'        => ['required'],
            'challenge_id' => ['required'],
        ]);

        $fields = $request->all();

        $subsection               = Subsection::findOrFail($subsectionId);
        $subsection->name         = $fields['name'];
        $subsection->color        = $fields['color'];
        $subsection->video_link   = $fields['video_link'] ?? null;
        $subsection->challenge_id = $fields['challenge_id'];
        $subsection->save();

        return response()->json($subsection);
    }

    public function delete(Request $request, $subsectionId)
    {
        $subsection = Subsection::findOrFail($subsectionId);
        $subsection->delete();

        return response()->noContent();
    }
}

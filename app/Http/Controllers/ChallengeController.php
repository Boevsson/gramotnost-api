<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function getAll(Request $request)
    {
        $challenges = Challenge::get();

        return response()->json($challenges);
    }

    public function getOne(Request $request, $challengeId)
    {
        $challenge = Challenge::findOrFail($challengeId);

        return response()->json($challenge);
    }

    public function getSubsections(Request $request, $challengeId)
    {
        $challenge = Challenge::findOrFail($challengeId);

        return response()->json($challenge->subsections);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name'          => ['required'],
        ]);

        $challenge = Challenge::create([
            'name'  => $fields['name'],
        ]);

        return response()->json($challenge);
    }

    public function update(Request $request, $challengeId)
    {
        $fields = $request->validate([
            'name'  => ['required'],
        ]);

        $challenge = Challenge::findOrFail($challengeId);
        $challenge->name  = $fields['name'];
        $challenge->save();

        return response()->json($challenge);
    }

    public function delete(Request $request, $challengeId)
    {
        $challenge = Challenge::findOrFail($challengeId);
        $challenge->delete();

        return response()->noContent();
    }
}

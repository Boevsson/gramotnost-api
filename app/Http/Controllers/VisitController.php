<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function getOne(Request $request)
    {
        $visit = Visit::first();

        return response()->json($visit);
    }

    public function update(Request $request)
    {
        $visit = Visit::first();
        $visit->visits = $visit->visits + 1;
        $visit->save();

        return response()->noContent();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\General;
use Illuminate\Http\Request;

class GeneralController extends Controller
{

    public function getOne(Request $request)
    {
        $general = General::first();

        return response()->json($general);
    }

    public function update(Request $request)
    {
        $fields = $request->validate([
            'logo'            => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'home_page_text'  => ['required'],
            'email'           => ['required'],
            'phone'           => ['required'],
            'address'         => ['required'],
        ]);

        $generalSettings = General::first();

        if ($file = $request->file('logo')) {

            $url = url('/');
            $path = $file->store('public');

            $generalSettings->logo_url        = "$url/storage/" . $file->hashName();
            $generalSettings->logo_local_path = '/storage/'.$path;
        }

        $generalSettings->home_page_text  = $fields['home_page_text'];
        $generalSettings->email           = $fields['email'];
        $generalSettings->phone           = $fields['phone'];
        $generalSettings->address         = $fields['address'];
        $generalSettings->save();

        return response()->json($generalSettings);
    }
}

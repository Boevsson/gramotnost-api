<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    public function getAll(Request $request)
    {
        $files = File::get();

        return response()->json($files);
    }

    public function getOne(Request $request, $fileId)
    {
        $file = File::with('pages')->findOrFail($fileId);

        return response()->json($file);
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:doc,docx,pdf,txt,csv,jpeg|max:2048',
        ]);

        if($validator->fails()) {

            return response()->json(['error'=>$validator->errors()], 401);
        }

        $fields = $request->validate([
            'name'           => ['required'],
        ]);

        if ($file = $request->file('file')) {
            $url = url('/');
            $filePath = $request->file('file')->store('public');

//          store your file into directory and db
            $save = new File();
            $save->name = $fields['name'];
            $save->image_path = $filePath;
            $save->local_path = '/storage/' . $filePath;
            $save->url = "$url/$filePath";
            $save->save();

            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $file
            ]);
        }
    }

    public function update(Request $request, $fileId)
    {
        $fields = $request->validate([
            'name'       => ['required'],
            'image_path' => ['required'],
        ]);

        $file = File::findOrFail($fileId);
        $file->name       = $fields['name'];
        $file->image_path = $fields['image_path'];
        $file->save();

        return response()->json($file);
    }

    public function delete(Request $request, $fileId)
    {
        $file = File::findOrFail($fileId);
        $file->delete();

        return response()->noContent();
    }


}

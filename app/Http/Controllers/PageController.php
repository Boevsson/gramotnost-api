<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function getAll(Request $request)
    {
        $pages = Page::get();

        return response()->json($pages);
    }

    public function getOne(Request $request, $slug)
    {
        $page = Page::with('files')->where('slug', $slug)->firstOrFail();

        return response()->json($page);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'title'       => ['required'],
            'text'        => ['string'],
            'pageFiles'   => ['array'],
            'pageFiles.*' => ['string'],
            'files.*'     => 'mimes:doc,docx,pdf,txt,csv|max:2048',
            'video_links' => ['string'],
        ]);

        $page        = new Page();
        $page->title = $fields['title'];
        $page->text  = $fields['text'];
        $page->slug  = Str::slug($page->title);

        if($fields['video_links']){

            $page->video_links = json_decode($fields['video_links']);
        }

        $page->save();

        if ($uploadedFiles = $request->file('files')) {

            foreach ($uploadedFiles as $index => $uploadedFile) {

                $url  = url('/');
                $path = $uploadedFile->store('public');

                $pageFileData = json_decode($fields['pageFiles'][$index], true);

                $file             = new File();
                $file->name       = $uploadedFile->hashName();
                $file->local_path = $path;
                $file->url        = "$url/storage/" . $uploadedFile->hashName();
                $file->save();

                $page->files()->attach($file->id, ['file_title' => $pageFileData['title'], 'file_text' => $pageFileData['text'], 'file_image_url' => $pageFileData['image_url']]);
            }
        }

        return response()->json($page);
    }

    public function update(Request $request, $questionId)
    {
        $fields = $request->validate([
            'title'       => ['required'],
            'text'        => ['string'],
            'pageFiles'   => ['array'],
            'pageFiles.*' => ['string'],
            'files.*'     => 'mimes:doc,docx,pdf,txt,csv',
            'video_links' => ['string'],
        ]);

        $page        = Page::findOrFail($questionId);
        $page->title = $fields['title'];
        $page->text  = $fields['text'];
        $page->slug  = Str::slug($page->title);

        if($fields['video_links']){

            $page->video_links = json_decode($fields['video_links']);
        }

        $page->save();

        if ($uploadedFiles = $request->file('files')) {

            foreach ($uploadedFiles as $index => $uploadedFile) {

                $url  = url('/');
                $path = $uploadedFile->store('public');

                $pageFileData = json_decode($fields['pageFiles'][$index], true);

                $file             = new File();
                $file->name       = $uploadedFile->getClientOriginalName();
                $file->local_path = $path;
                $file->url        = "$url/storage/" . $uploadedFile->hashName();
                $file->save();

                $page->files()->attach($file->id, ['file_title' => $pageFileData['title'], 'file_text' => $pageFileData['text'], 'file_image_url' => $pageFileData['image_url']]);
            }
        }

        if($request->has('files_to_delete')){

            $filesIdsToDelete = json_decode($request->files_to_delete);

            foreach ($filesIdsToDelete as $fileId) {

                $file       = File::find($fileId);
                $filePageId = $file->pages[0]->id;

                if ($filePageId == $page->id) {

                    $filePath = $file->local_path;
                    $file->delete();

                    Storage::delete($filePath);
                }
            }
        }

        return response()->json($page);
    }

    public function deleteFile(Request $request, $singleFileId)
    {
        $file = File::findOrFail($singleFileId);
        $file->delete();

        return response(200);
    }

    public function delete(Request $request, $fileId)
    {
        $file = Page::findOrFail($fileId);
        $file->delete();

        return response()->noContent();
    }
}

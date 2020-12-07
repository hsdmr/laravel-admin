<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function index()
    {
        $medias = File::orderBy('created_at', 'desc')->where('collection','=','default')->simplePaginate(80);
        return view("admin.media.index",compact('medias'));
    }

    public function create()
    {
        return view("admin.media.create");
    }

    public function store(Request $request)
    {
        foreach ($request->input('document', []) as $file) {
            $medias = new File();
            $medias->role = Auth::user()->role;
            $medias->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection();
            $medias->save();
        }
        $target = storage_path('tmp/uploads');
        delete_files($target);
        $medias = File::orderBy('created_at', 'desc')->where('collection','=','default')->simplePaginate(20);
        return redirect()->route('admin.media.index');
    }

    public function show($id)
    {
        $media = File::find($id);
        return view('admin.media.show',compact('media'));
    }

    public function edit($id)
    {
        $media = File::find($id);
        return view('admin.media.edit',compact('media'));
    }

    public function update(Request $request, $id)
    {
        if(isset($request->form_img)){
            $media = File::find($id);
            $mediaItem = $media->getMedia();
            $mediaItem[0]->name = $request->media_title;
            $mediaItem[0]->alt = $request->media_alt;
            if(true){
                return "success,Media Information Updated.";
            }
            else{
                return "error,Error Occurred While Updating Media Information.";
            };
        }
        else{
            $media = File::find($id);
            $mediaItem = $media->getMedia();
            $mediaItem[0]->name = $request->title;
            $mediaItem[0]->alt = $request->alt;
            $mediaItem[0]->save();
            return view('admin.media.show',compact('media'));
        }
    }

    public function destroy($id)
    {
        $media = File::find($id);
        $media->delete();
        return redirect()->route('admin.media.index');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}

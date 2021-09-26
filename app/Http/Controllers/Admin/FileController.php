<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Throwable;

class FileController extends Controller
{
    public function index()
    {
        try {
            $medias = File::orderBy('created_at', 'desc')->where('collection','=','default')->simplePaginate(80);
            return view("admin.media.index",compact('medias'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'file',
                'message' => 'Medias page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Medias page could not be loaded.']);
        }
    }

    public function create()
    {
        try {
            return view("admin.media.create");
        } catch (Throwable $th) {
            Log::create([
                'model' => 'file',
                'message' => 'The media edit page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'The media edit page could not be loaded.']);
        }
    }

    public function store(Request $request)
    {
        try {
            foreach ($request->input('document', []) as $file) {
                $medias = new File();
                $medias->role = Auth::user()->role;
                $medias->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection();
                $medias->save();
            }
            $target = storage_path('tmp/uploads');
            delete_files($target);
            $medias = File::orderBy('created_at', 'desc')->where('collection','=','default')->simplePaginate(20);
            return redirect()->route('admin.media.index')->with(['type' => 'success', 'message' =>'Medias saved.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'file',
                'message' => 'The media could not be saved.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'The media could not be saved.']);
        }
    }

    public function show($id)
    {
        try {
            $media = File::find($id);
            return view('admin.media.show',compact('media'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'file',
                'message' => 'The media show page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'The media show page could not be loaded.']);
        }
    }

    public function edit($id)
    {
        try {
            $media = File::find($id);
            return view('admin.media.edit',compact('media'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'file',
                'message' => 'The media edit page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'The media edit page could not be loaded.']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
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
        } catch (Throwable $th) {
            Log::create([
                'model' => 'file',
                'message' => 'Media could not be updated.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Media could not be updated.']);
        }
    }

    public function destroy($id)
    {
        try {
            $media = File::find($id);
            $media->delete();
            return redirect()->route('admin.media.index')->with(['type' => 'success', 'message' =>'Media moved to recycle bin.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'file',
                'message' => "Media couldn't be moved to recycle bin.",
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>"Media couldn't be moved to recycle bin."]);
        }
    }

    public function storeMedia(Request $request)
    {
        try {
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
        } catch (Throwable $th) {
            Log::create([
                'model' => 'file',
                'message' => "Media couldn't be moved to temp directory.",
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>"Media couldn't be moved to temp directory."]);
        }
    }
}

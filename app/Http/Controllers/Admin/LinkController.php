<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\Log;
use Illuminate\Http\Request;
use Throwable;

class LinkController extends Controller
{
    public function index()
    {
        try {
            $links = Link::all();
            return view('admin.linker.index',compact('links'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'link',
                'message' => 'Auto links page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Auto links page could not be loaded.']);
        }
    }

    public function create()
    {
        try {
            return view('admin.linker.create');
        } catch (Throwable $th) {
            Log::create([
                'model' => 'link',
                'message' => 'Auto link create page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Auto link create page could not be loaded.']);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|min:3|max:255',
            'word' => 'required|min:3|max:255',
        ]);
        try {
            Link::create([
                'url' => $request->url,
                'word' => $request->word
            ]);
            return redirect()->route('admin.option.link.index')->with(['type' => 'success', 'message' =>'Auto link saved.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'link',
                'message' => 'Auto link could not be stored.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Auto link could not be stored.']);
        }
    }

    public function edit(Link $link)
    {
        try {
            return view('admin.linker.edit',compact('link'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'link',
                'message' => 'Auto link edit page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Auto link edit page could not be loaded.']);
        }
    }

    public function update(Request $request, Link $link)
    {
        $request->validate([
            'url' => 'required|min:3|max:255',
            'word' => 'required|min:3|max:255',
        ]);
        try {
            $link->update([
                'url' => $request->url,
                'word' => $request->word
            ]);
            return redirect()->route('admin.option.link.index')->with(['type' => 'success', 'message' =>'Auto link updated.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'link',
                'message' => 'Auto link could not be updated.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Auto link could not be updated.']);
        }
    }

    public function destroy(Link $link)
    {
        try {
            $link->delete();
            return redirect()->route('admin.option.link.index')->with(['type' => 'success', 'message' =>'Auto link deleted.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'link',
                'message' => 'Failed to delete auto link.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Failed to delete auto link.']);
        }
    }
}

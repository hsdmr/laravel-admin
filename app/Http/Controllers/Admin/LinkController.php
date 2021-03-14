<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::all();
        return view('admin.linker.index',compact('links'));
    }

    public function create()
    {
        return view('admin.linker.create');
    }

    public function store(Request $request)
    {
        $link = new Link();
        $link->url = $request->url;
        $link->word = $request->word;
        $link->save();
        return redirect()->route('admin.option.link.index')->with(['type' => 'success', 'message' =>'Oto Linkleme Eklendi.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $link = Link::find($id);
        return view('admin.linker.edit',compact('link'));
    }

    public function update(Request $request, $id)
    {
        $link = Link::find($id);
        $link->url = $request->url;
        $link->word = $request->word;
        $link->save();
        return redirect()->route('admin.option.link.index')->with(['type' => 'success', 'message' =>'Oto Linkleme Düzenlendi.']);
    }

    public function destroy($id)
    {
        $link = Link::find($id);
        $link->delete();
        return redirect()->route('admin.option.link.index')->with(['type' => 'success', 'message' =>'Oto Linkleme Silindi.']);
    }
}

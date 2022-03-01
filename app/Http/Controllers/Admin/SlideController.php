<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        $languages = Option::where('key','=','language')->get();
        return view('admin.slides.index',compact('slides','languages'));
    }

    public function create()
    {
        $languages = Option::where('key','=','language')->get();
        return view('admin.slides.create',compact('languages'));
    }
    public function store(Request $request)
    {
        $slide = new Slide;
        $slide->color = $request->color;
        $slide->opacity = $request->opacity;
        $slide->is_video = $request->is_video;
        $slide->bg = $request->bg;
        $slide->order = $request->order;
        $slide->language = $request->language;
        $slide->link = $request->link;
        $slide->title = $request->title;
        $slide->content = $request->content;
        $slide->button = $request->button;
        $slide->save();
        return redirect()->route('admin.slide.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $slide = Slide::find($id);
        $languages = Option::where('key','=','language')->get();
        return view('admin.slides.edit',compact('slide','languages'));
    }

    public function update(Request $request, $id)
    {
        $slide = Slide::find($id);
        $slide->color = $request->color;
        $slide->opacity = $request->opacity;
        $slide->is_video = $request->is_video;
        $slide->bg = $request->bg;
        $slide->order = $request->order;
        $slide->language = $request->language;
        $slide->link = $request->link;
        $slide->title = $request->title;
        $slide->content = $request->content;
        $slide->button = $request->button;
        $slide->save();
        return redirect()->route('admin.slide.index');
    }

    public function destroy($id)
    {
        Slide::find($id)->delete();
        return redirect()->route('admin.slide.index');
    }
}

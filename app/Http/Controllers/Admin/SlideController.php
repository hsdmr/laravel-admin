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
        $languages = Option::where('name','=','language')->get();
        return view('admin.slides.index',compact('slides','languages'));
    }

    public function create()
    {
        $languages = Option::where('name','=','language')->get();
        return view('admin.slides.create',compact('languages'));
    }
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $slide = Slide::find($id);
        $languages = Option::where('name','=','language')->get();
        return view('admin.slides.edit',compact('slide','languages'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Option;
use Illuminate\Http\Request;

class TutorCourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('course_id','=',0)->get();
        return view("admin.tutor.course.index",compact('courses'));
    }

    public function create()
    {
        $languages = Option::where('name','=','language')->get();
        $categories = Category::where('type','=','tutor-category')->get();
        return view("admin.tutor.course.create",compact('languages','categories'));
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
        //
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

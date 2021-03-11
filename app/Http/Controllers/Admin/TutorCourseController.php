<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Option;
use App\Models\Slug;
use Illuminate\Http\Request;

class TutorCourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
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
        $slug = new Slug();
        if($request->slug==null){
            $slug_last = $slug->latest()->first()->id+1;
            $request->slug = "article-".$slug_last;
        }else{
            $slug_check = Slug::withTrashed()->where('slug', '=', $request->slug)->first();
            if($slug_check!=null) $request->slug = $request->slug."-".uniqid();
        }
        $slug->owner = 'course';
        $slug->slug = $request->slug;
        $slug->seo_title = $request->seo_title;
        $slug->seo_description = $request->seo_description;
        $slug->no_index = ($request->no_index==null ? 0 : 1);
        $slug->no_follow = ($request->no_follow==null ? 0 : 1);
        $slug->save();

        $course = new Course();
        $course->slug_id = $slug->id;
        $course->media_id = ($request->media_id==null ? 1 : $request->media_id);
        $course->category_id = ($request->category_id==null ? 1 : $request->category_id);
        $course->title = ($request->title==null ? $request->slug : $request->title);
        $course->content = $request->content;
        $course->language = $request->language;
        $course->what_to_learn = $request->what_to_learn;
        $course->requirements = $request->requirements;
        $course->for_who = $request->for_who;
        $course->includes = $request->includes;
        $course->video = $request->video;
        $course->time = serialize($request->time);
        $course->difficulty = $request->difficulty;
        $course->price = serialize($request->price);
        $course->save();

        return redirect()->route('admin.tutor.course.index')->with(['type' => 'success', 'message' =>'Course Saved.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $course = Course::find($id);
        $course->time = unserialize($course->time);
        $course->price = unserialize($course->price);
        $languages = Option::where('name','=','language')->get();
        $categories = Category::where('type','=','tutor-category')->get();
        return view("admin.tutor.course.edit",compact('languages','categories','course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        $slug = Slug::find($course->slug_id);

        if($request->slug==null){
            $slug_last = $slug->latest()->first()->id+1;
            $request->slug = "article-".$slug_last;
        }else{
            $slug_check = Slug::withTrashed()->where('slug', '=', $request->slug)->first();
            if($slug_check!=null) $request->slug = $request->slug."-".uniqid();
        }
        $slug->owner = 'course';
        $slug->slug = $request->slug;
        $slug->seo_title = $request->seo_title;
        $slug->seo_description = $request->seo_description;
        $slug->no_index = ($request->no_index==null ? 0 : 1);
        $slug->no_follow = ($request->no_follow==null ? 0 : 1);
        $slug->save();

        $course->slug_id = $slug->id;
        $course->media_id = ($request->media_id==null ? 1 : $request->media_id);
        $course->category_id = ($request->category_id==null ? 1 : $request->category_id);
        $course->title = ($request->title==null ? $request->slug : $request->title);
        $course->content = $request->content;
        $course->language = $request->language;
        $course->what_to_learn = $request->what_to_learn;
        $course->requirements = $request->requirements;
        $course->for_who = $request->for_who;
        $course->includes = $request->includes;
        $course->video = $request->video;
        $course->difficulty = $request->difficulty;
        $course->price = serialize($request->price);
        $course->save();

        return redirect()->route('admin.tutor.course.index')->with(['type' => 'success', 'message' =>'Course Updated.']);
    }

    public function destroy($id)
    {
        Course::find($id)->delete();
        return redirect()->route('admin.tutor.course.index')->with(['type' => 'success', 'message' =>'Course Deleted.']);
    }
}

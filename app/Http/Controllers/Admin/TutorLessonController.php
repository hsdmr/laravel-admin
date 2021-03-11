<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class TutorLessonController extends Controller
{
    public function index()
    {
        //
    }

    public function create($course,$topic)
    {
        return view('admin.tutor.lesson.create',compact('course','topic'));
    }

    public function store(Request $request,$course,$topic)
    {
        $lesson = new Lesson();
        $lesson->course_id = $course;
        $lesson->lesson_id = $topic;
        $lesson->media_id = $request->media_id==""? 1 : $request->media_id;
        $lesson->title = $request->title;
        $lesson->content = $request->content;
        $lesson->video = $request->video;
        $lesson->time = serialize($request->time);
        $lesson->preview = $request->preview=='on'? 1 : 0;
        $lesson->save();

        return redirect()->route('admin.tutor.course.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $lesson = Lesson::find($id);
        $lesson->time = unserialize($lesson->time);
        return view('admin.tutor.lesson.edit',compact('lesson'));
    }

    public function update(Request $request, $id)
    {
        $lesson = Lesson::find($id);
        $lesson->media_id = $request->media_id==""? 1 : $request->media_id;
        $lesson->title = $request->title;
        $lesson->content = $request->content;
        $lesson->video = $request->video;
        $lesson->time = serialize($request->time);
        $lesson->preview = $request->preview=='on'? 1 : 0;
        $lesson->save();

        return redirect()->route('admin.tutor.course.index');
    }

    public function delete($id)
    {
        Lesson::find($id)->delete();
        return redirect()->route('admin.tutor.course.index');
    }
}

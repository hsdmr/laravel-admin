<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Course;
use Illuminate\Http\Request;

class TutorAnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();
        return view('admin.tutor.announcement.index',compact('announcements'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.tutor.announcement.create',compact('courses'));
    }

    public function store(Request $request)
    {
        $announcement = new Announcement;
        $announcement->course_id = $request->course_id;
        $announcement->title = $request->title;
        $announcement->content = $request->content;
        $announcement->save();

        return redirect()->route('admin.tutor.announcement.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $announcement = Announcement::find($id);
        $courses = Course::all();
        return view('admin.tutor.announcement.edit',compact('announcement','courses'));
    }

    public function update(Request $request, $id)
    {
        $announcement = Announcement::find($id);
        $announcement->course_id = $request->course_id;
        $announcement->title = $request->title;
        $announcement->content = $request->content;
        $announcement->save();

        return redirect()->route('admin.tutor.announcement.index');
    }

    public function destroy($id)
    {
        Announcement::find($id)->delete();
        return redirect()->route('admin.tutor.announcement.index');
    }
}

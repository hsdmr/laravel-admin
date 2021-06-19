<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class TutorZoomController extends Controller
{
    public function index()
    {
        $zooms = Lesson::where('zoom','!=',null)->get();
        return view('admin.tutor.zoom.index',compact('zooms'));
    }

    public function create($course,$topic)
    {
        return view('admin.tutor.zoom.create',compact('course','topic'));
    }

    public function store(Request $request, $course, $topic)
    {
        $zoom = [
            'zoomTitle' => $request->title,
            'zoomContent' => $request->content,
            'zoomDate' => $request->date,
            'zoomTime' => $request->time,
            'zoomTimeZone' => $request->time_zone,
            'zoomRecord' => $request->record,
            'zoomDuration' => $request->duration,
            'zoomPassword' => $request->password,
        ];
        $lesson = new Lesson;
        $lesson->course_id = $course;
        $lesson->lesson_id = $topic;
        $lesson->zoom = serialize($zoom);
        $lesson->media_id = $request->media_id==""? 1 : $request->media_id;
        $lesson->preview = $request->preview=='on'? 1 : 0;
        $lesson->save();
        return redirect()->route('admin.tutor.zoom.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $zoom = Lesson::find($id);
        return view('admin.tutor.zoom.edit',compact('zoom'));
    }

    public function update(Request $request, $id)
    {

        $zoom = [
            'zoomTitle' => $request->title,
            'zoomContent' => $request->content,
            'zoomDate' => $request->date,
            'zoomTime' => $request->time,
            'zoomTimeZone' => $request->time_zone,
            'zoomRecord' => $request->record,
            'zoomDuration' => $request->duration,
            'zoomPassword' => $request->password,
        ];
        $lesson = Lesson::find($id);
        $lesson->zoom = serialize($zoom);
        $lesson->save();
        return redirect()->route('admin.tutor.zoom.index');
    }

    public function destroy($id)
    {
        Lesson::find($id)->delete();
        return redirect()->route('admin.tutor.zoom.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function ajax(Request $request){
        $JSON = array();
        if($request->select=='topic'){
            $course_id = $request->course_id;
            $lesson_id = $request->lesson_id;
            if($lesson_id==0){
                $topic = new Lesson;
                $topic->media_id = 1;
                $topic->course_id = $course_id;
                $topic->title = $request->title;
                $topic->content = $request->content;
                $topic->save();
            }
            $lessons = Lesson::where('course_id','=',$course_id)->get();
            foreach($lessons as $item){
                array_push($JSON,$item);
            }

        return response()->json([
            'json'    => $JSON,
            'course_id'    => $course_id,
            'select'    => $request->select,
        ]);
        }
    }
}

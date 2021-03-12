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
                $is_edit = false;
                $topic = new Lesson;
                $topic->media_id = 1;
                $topic->course_id = $course_id;
                $topic->title = $request->title;
                $topic->content = $request->content;
                $topic->save();
            }
            else{
                $is_edit = true;
                $topic = Lesson::find($lesson_id);
                $topic->title = $request->title;
                $topic->content = $request->content;
                $topic->save();
            }
            array_push($JSON,$topic);

            return response()->json([
                'json'    => $JSON,
                'course_id'    => $course_id,
                'is_edit'    => $is_edit,
                'select'    => $request->select,
            ]);
        }

        if($request->select=='topic-delete'){
            $topic_id = $request->topic_id;
            Lesson::find($topic_id)->delete();
            return response()->json([
                'topic_id'    => $topic_id,
                'select'    => $request->select,
            ]);
        }

        if($request->select=='topic-edit'){
            $topic_id = $request->topic_id;
            $topic = Lesson::find($topic_id);
            array_push($JSON,$topic);
            return response()->json([
                'json'    => $JSON,
                'topic_id'    => $topic_id,
                'select'    => $request->select,
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function ajax(Request $request){
        $JSON = array();
        if($request->select=='course'){
            $lessons = Lesson::where('course_id','=',$request->course_id)->get();
            foreach($lessons as $item){
                array_push($JSON,$item);
            }
        }
    }
}

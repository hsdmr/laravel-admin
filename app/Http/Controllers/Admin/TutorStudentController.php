<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TutorStudentController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.tutor.student.index',compact('users'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.tutor.student.create',compact('courses'));
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        $meta = new UserMeta();
        $meta->user_id = $user->id;
        $meta->key = 'student_courses';
        $meta->value = serialize($request->courses);
        $meta->save();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $courses = Course::all();
        $user = User::find($id);
        $metas = UserMeta::where('user_id','=',$id)->get();
        foreach ($metas as $meta){
            $user_meta[$meta->key] = $meta->value;
        };
        return view('admin.tutor.student.edit',compact('courses','user','user_meta'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->role = $request->role;
        $request->password==null ? "" : $user->password = Hash::make($request->password);
        $user->save();

        foreach($request->metas as $key => $value){
            $meta = UserMeta::where('user_id','=',$user->id)->where('key','=',$key)->first();
            if($meta!=null){
                $meta->value = serialize($value);
                $meta->save();
            }
            else{
                $meta = new UserMeta();
                $meta->user_id = $user->id;
                $meta->key = $key;
                $meta->value = serialize($value);
                $meta->save();
            }
        }
        return redirect()->route('admin.tutor.student.edit',$id);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $metas = UserMeta::where('user_id','=',$user->id)->get();
        foreach($metas as $meta){
            $meta->delete();
        }
        $user->delete();
    }
}

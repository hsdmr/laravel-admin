<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index',compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.user.edit',$user->id)->with(['type' => 'success', 'message' =>'User Created.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->role = $request->role;
        $request->password==null ? "" : $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.user.edit',$user->id)->with(['type' => 'success', 'message' =>'User Created.']);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.user.index')->with(['type' => 'success', 'message' =>'User Moved to Recycle Bin.']);
    }

    public function trash()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.user.trash',compact('users'));
    }

    public function recover($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        return redirect()->route('admin.user.trash')->with(['type' => 'success', 'message' =>'User Recovered.']);
    }

    public function destroy($id)
    {
        $user = User::withTrashed()->find($id);
        $user->forceDelete();
        return redirect()->route('admin.user.trash')->with(['type' => 'error', 'message' =>'User Deleted.']);
    }

}

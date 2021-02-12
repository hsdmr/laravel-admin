<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redirect;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index()
    {
        $redirects = Redirect::all();
        return view('admin.redirect.index',compact('redirects'));
    }

    public function create()
    {
        return view('admin.redirect.create');
    }

    public function store(Request $request)
    {
        $redirect = new Redirect();
        $redirect->to = $request->to;
        $redirect->from = $request->from;
        $redirect->type = $request->type;
        $redirect->save();
        return redirect()->route('admin.setting.redirect.index')->with(['type' => 'success', 'message' =>'Yönlendirme Oluşturuldu.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $redirect = Redirect::find($id);
        return view('admin.redirect.edit',compact('redirect'));
    }

    public function update(Request $request, $id)
    {
        $redirect = Redirect::find($id);
        $redirect->to = $request->to;
        $redirect->from = $request->from;
        $redirect->type = $request->type;
        $redirect->save();
        return redirect()->route('admin.setting.redirect.index')->with(['type' => 'success', 'message' =>'Yönlendirme Düzenlendi.']);
    }

    public function destroy($id)
    {
        $redirect = Redirect::find($id);
        $redirect->delete();
        return redirect()->route('admin.setting.redirect.index')->with(['type' => 'success', 'message' =>'Yönlendirme Silindi.']);
    }
}

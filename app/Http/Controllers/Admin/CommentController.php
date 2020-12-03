<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comment.index',compact('comments'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('admin.comment.edit',compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->title = $request->title;
        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('admin.comment.edit',$id)->with(['type' => 'success', 'message' =>'Yorum Güncellendi.']);
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route('admin.comment.index')->with(['type' => 'success', 'message' =>'Yorum Geri Dönüşüm Kutusuna Taşındı.']);
    }

    public function trash()
    {
        $comments = Comment::onlyTrashed()->get();
        return view('admin.comment.trash',compact('comments'));
    }

    public function recover($id)
    {
        $comment = Comment::withTrashed()->find($id);
        $comment->restore();
        return redirect()->route('admin.comment.trash')->with(['type' => 'success', 'message' =>'Yorum Kurtarıldı.']);
    }

    public function destroy($id)
    {
        $comment = Comment::withTrashed()->find($id);
        $comment->forceDelete();
        return redirect()->route('admin.comment.trash')->with(['type' => 'error', 'message' =>'Yorum Silindi.']);
    }

    public function switch(Request $request)
    {
        $comment = Comment::find($request->id);
        $comment->statu = $request->statu=="true" ? 1 : 0;
        $comment->save();
        return $request->statu;
    }
}

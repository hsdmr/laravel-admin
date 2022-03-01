<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Log;
use App\Models\Option;
use Illuminate\Http\Request;
use Throwable;

class CommentController extends Controller
{
    public function index()
    {
        try {
            $comments = Comment::all();
            return view('admin.comment.index',compact('comments'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'comment',
                'message' => 'Comments page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Comments page could not be loaded.']);
        }
    }

    public function edit(Comment $comment)
    {
        try {
            $languages = Option::where('key','=','language')->get();
            return view('admin.comment.edit',compact('comment','languages'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'comment',
                'message' => 'The comment edit page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'The article edit page could not be loaded.']);
        }
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'language' => 'required',
            'content' => 'required|min:3',
        ]);
        try {
            $comment->update($request->only('title','content','language'));
            return redirect()->route('admin.comment.edit',$comment->id)->with(['type' => 'success', 'message' =>'The Comment Updated.']);
        } catch(Throwable $th) {
            Log::create([
                'model' => 'Comment',
                'message' => 'The comment could not be updated.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'success', 'message' =>'The comment could not be updated.']);
        }
    }

    public function delete(Comment $comment)
    {
        try {
            $comment->delete();
            return redirect()->route('admin.comment.index')->with(['type' => 'success', 'message' =>'The Comment Moved to Recycle Bin.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'comment',
                'message' => 'The comment could not be deleted.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'The comment could not be deleted.']);
        }
    }

    public function trash()
    {
        try {
            $comments = Comment::onlyTrashed()->get();
            return view('admin.comment.trash',compact('comments'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'comment',
                'message' => 'Comments trash page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Comments trash page could not be loaded.']);
        }
    }

    public function recover($id)
    {
        try {
            Comment::withTrashed()->find($id)->restore();
            return redirect()->route('admin.comment.trash')->with(['type' => 'success', 'message' =>'The Comment Recovered']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'comment',
                'message' => 'The comment could not be recovered.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'The comment could not be recovered.']);
        }
    }

    public function destroy($id)
    {
        try {
            Comment::withTrashed()->find($id)->forceDelete();
            return redirect()->route('admin.comment.trash')->with(['type' => 'error', 'message' =>'The Comment Has Been Deleted.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'comment',
                'message' => 'The comment could not be destroyed.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'The comment could not be destroyed.']);
        }
    }

    public function switch(Request $request)
    {
        try {
            Comment::find($request->id)->update([
                'status' => $request->status=="true" ? 1 : 0
            ]);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'article',
                'message' => 'The article could not be switched.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
        }
        return $request->status;
    }
}

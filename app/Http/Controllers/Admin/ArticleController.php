<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slug;
use App\Models\Article;
use App\Models\Log;
use App\Models\Option;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ArticleController extends Controller
{
    public function index()
    {
        try {
            $articles = Article::all();
            return view('admin.article.index',compact('articles'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'article',
                'message' => 'Articles page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Articles page could not be loaded.']);
        }
    }

    public function create()
    {
        try {
            $categories = Category::all();
            $languages = Option::where('name','=','language')->get();
            return view('admin.article.create',compact('categories','languages'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'article',
                'message' => 'The article create page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->route('admin.article.index')->with(['type' => 'error', 'message' =>'The article create page could not be loaded.']);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255',
            'language' => 'required',
            'no_index' => 'nullable|accepted',
            'no_follow' => 'nullable|accepted',
            'media_id' => 'nullable|numeric|min:1',
            'category_id' => 'nullable|numeric|min:1',
        ]);
        try {
            $slug = Slug::create([
                'slug' => slugCheck($request->slug),
                'owner' => 'article',
                'seo_title' => $request->seo_title,
                'seo_description' => $request->seo_description,
                'no_index' => $request->no_index=='on' ? 1 : 0,
                'no_follow' => $request->no_follow=='on' ? 1 : 0,
            ]);

            $article = Article::create([
                'slug_id' => $slug->id,
                'user_id' => Auth::id(),
                'media_id' => $request->media_id ?? 1,
                'category_id' => $request->category_id ?? 1,
                'title' => $request->title,
                'content' => $request->content,
                'language' => $request->language,
            ]);

            return redirect()->route('admin.article.edit',$article->id)->with(['type' => 'success', 'message' =>'Post Saved.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'article',
                'message' => 'The article could not be saved.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->route('admin.article.create')->with(['type' => 'error', 'message' =>'The article could not be saved.']);
        }
    }

    public function edit(Article $article)
    {
        try {
            $categories = Category::all();
            $languages = Option::where('name','=','language')->get();
            return view('admin.article.edit',compact('categories','article','languages'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'article',
                'message' => 'The article edit page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->route('admin.article.index')->with(['type' => 'error', 'message' =>'The article edit page could not be loaded.']);
        }
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255',
            'language' => 'required',
            'no_index' => 'nullable|accepted',
            'no_follow' => 'nullable|accepted',
            'media_id' => 'nullable|numeric|min:1',
            'category_id' => 'nullable|numeric|min:1',
        ]);
        try {
            $article->getSlug()->update([
                'slug' => slugCheck($request->slug, $article->slug_id),
                'owner' => 'article',
                'seo_title' => $request->seo_title,
                'seo_description' => $request->seo_description,
                'no_index' => $request->no_index=='on' ? 1 : 0,
                'no_follow' => $request->no_follow=='on' ? 1 : 0,
            ]);

            $article->update([
                'media_id' => $request->media_id ?? 1,
                'category_id' => $request->category_id ?? 1,
                'title' => $request->title,
                'content' => $request->content,
                'language' => $request->language,
            ]);

            return redirect()->route('admin.article.edit',$article->id)->with(['type' => 'success', 'message' =>'The Post Has Been Updated.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'article',
                'message' => 'The article could not be updated.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->route('admin.article.edit',$article->id)->with(['type' => 'error', 'message' =>'The article could not be updated.']);
        }
    }

    public function delete(Article $article)
    {
        try {
            $article->delete();
            return redirect()->route('admin.article.index')->with(['type' => 'success', 'message' =>'Post Moved To Recycle Bin.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'article',
                'message' => 'The article could not be deleted.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->route('admin.article.index')->with(['type' => 'error', 'message' =>'The article could not be deleted.']);
        }
    }

    public function trash()
    {
        try {
            $articles = Article::onlyTrashed()->get();
            return view('admin.article.trash',compact('articles'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'article',
                'message' => 'Articles trash page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->route('admin.article.index')->with(['type' => 'error', 'message' =>'Articles trash page could not be loaded.']);
        }
    }

    public function recover($id)
    {
        try {
            Article::withTrashed()->find($id)->restore();
            return redirect()->route('admin.article.trash')->with(['type' => 'success', 'message' =>'Post Recovered.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'article',
                'message' => 'The article could not be recovered.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->route('admin.article.trash')->with(['type' => 'error', 'message' =>'The article could not be recovered.']);
        }
    }

    public function destroy($id)
    {
        try {
            $article = Article::withTrashed()->find($id);
            $article->getSlug()->delete();
            $article->forceDelete();
            return redirect()->route('admin.article.trash')->with(['type' => 'warning', 'message' =>'Post Deleted.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'article',
                'message' => 'The article could not be destroyed.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->route('admin.article.trash')->with(['type' => 'error', 'message' =>'The article could not be destroyed.']);
        }
    }

    public function switch(Request $request)
    {
        try {
            Article::find($request->id)->update([
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

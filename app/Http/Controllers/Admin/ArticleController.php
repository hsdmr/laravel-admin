<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slug;
use App\Models\File;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('admin.article.index',compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.article.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $slug = new Slug;
        if($request->slug==null){
            $slug_last = $slug->latest()->first()->id+1;
            $request->slug = "article-".$slug_last;
        }else{
            $slug_check = Slug::withTrashed()->where('slug', '=', $request->slug)->first();
            if($slug_check!=null) $request->slug = $request->slug."-".uniqid();
        }
        $slug->owner = 'article';
        $slug->slug = $request->slug;
        $slug->seo_title = $request->seo_title;
        $slug->seo_description = $request->seo_description;
        $slug->no_index = ($request->no_index==null ? 0 : 1);
        $slug->no_follow = ($request->no_follow==null ? 0 : 1);
        $slug->save();

        $article = new Article();
        $article->slug_id = $slug->id;
        $article->user_id = Auth::id();
        $article->media_id = ($request->media_id==null ? 1 : $request->media_id);
        $article->category_id = ($request->category_id==null ? 1 : $request->category_id);
        $article->title = ($request->title==null ? $request->slug : $request->title);
        $article->content = $request->content;
        $article->save();

        return redirect()->route('admin.article.edit',$article->id)->with(['type' => 'success', 'message' =>'Yazı Kaydedildi.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categories = Category::all();
        $article = Article::find($id);
        return view('admin.article.edit',compact('categories','article'));
    }

    public function update(Request $request, $id)
    {
        if(isset($request->form)){
            $article = Article::find($id);
            $slug = Slug::find($article->slug_id);

            if($request->slug==null){
                $slug_last = $slug->latest()->first()->id+1;
                $request->slug = "article-".$slug_last;
            }else{
                $slug_check = Slug::withTrashed()->where('slug', '=', $request->slug)->first();
                if($slug_check!=null){
                    if($slug_check->id!=$article->slug_id) $request->slug = $request->slug."-".uniqid();
                }
            }
            $slug->owner = 'article';
            $slug->slug = $request->slug;
            $slug->seo_title = $request->seo_title;
            $slug->seo_description = $request->seo_description;
            $slug->no_index = ($request->no_index==null ? 0 : 1);
            $slug->no_follow = ($request->no_follow==null ? 0 : 1);
            $slug->save();

            $article->slug_id = $slug->id;
            $article->media_id = ($request->media_id==null ? 1 : $request->media_id);
            $article->category_id = ($request->category_id==null ? 1 : $request->category_id);
            $article->title = ($request->title==null ? $request->slug : $request->title);
            $article->content = $request->content;
            $article->save();

            return redirect()->route('admin.article.edit',$id)->with(['type' => 'success', 'message' =>'Yazı Güncellendi.']);
        };
    }

    public function delete($id)
    {
        $article = Article::find($id);
        Slug::find($article->slug_id)->delete();
        $article->delete();
        return redirect()->route('admin.article.index')->with(['type' => 'success', 'message' =>'Yazı Geri Dönüşüm Kutusuna Taşındı.']);
    }

    public function trash()
    {
        $articles = Article::onlyTrashed()->get();
        return view('admin.article.trash',compact('articles'));
    }

    public function recover($id)
    {
        $article = Article::withTrashed()->find($id);
        Slug::withTrashed()->find($article->slug_id)->restore();
        $article->restore();
        return redirect()->route('admin.article.trash')->with(['type' => 'success', 'message' =>'Yazı Kurtarıldı.']);
    }

    public function destroy($id)
    {
        $article = Article::withTrashed()->find($id);
        $slug = Slug::withTrashed()->find($article->slug_id);
        $article->forceDelete();
        $slug->forceDelete();
        return redirect()->route('admin.article.trash')->with(['type' => 'error', 'message' =>'Yazı Silindi.']);
    }

    public function switch(Request $request)
    {
        $page = Article::find($request->id);
        $page->statu = $request->statu=="true" ? 1 : 0;
        $page->save();
        return $request->statu;
    }
}

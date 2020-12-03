<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slug;
use App\Models\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("admin.category.index",compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view("admin.category.create",compact('categories'));
    }

    public function store(Request $request)
    {
        $slug = new Slug;
        if($request->slug==null){
            $slug_last = $slug->latest()->first()->id+1;
            $request->slug = "category-".$slug_last;
        }else{
            $slug_check = Slug::withTrashed()->where('slug', '=', $request->slug)->first();
            if($slug_check!=null) $request->slug = $request->slug."-".uniqid();
        }
        $slug->owner = 'category';
        $slug->slug = $request->slug;
        $slug->seo_title = $request->seo_title;
        $slug->seo_description = $request->seo_description;
        $slug->no_index = ($request->no_index==null ? 0 : 1);
        $slug->no_follow = ($request->no_follow==null ? 0 : 1);
        $slug->save();

        $category = new Category;
        $category->title = $request->title;
        $category->slug_id = $slug->id;
        $category->media_id = ($request->media_id==null ? 1 : $request->media_id);
        $category->upper = $request->upper;
        $category->content = $request->content;
        $category->save();
        return redirect()->route('admin.category.index')->with(['type' => 'success', 'message' =>'Kategori Kaydedildi.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all();
        return view('admin.category.edit',compact('category','categories'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $slug = Slug::find($category->slug_id);

        if($request->slug==null){
            $slug_last = $slug->latest()->first()->id+1;
            $request->slug = "category-".$slug_last;
        }else{
            $slug_check = Slug::withTrashed()->where('slug', '=', $request->slug)->first();
            if($slug_check!=null){
                if($slug_check->id!=$category->slug_id) $request->slug = $request->slug."-".uniqid();
            }
        }

        $slug->owner = 'category';
        $slug->slug = $request->slug;
        $slug->seo_title = $request->seo_title;
        $slug->seo_description = $request->seo_description;
        $slug->no_index = ($request->no_index==null ? 0 : 1);
        $slug->no_follow = ($request->no_follow==null ? 0 : 1);
        $slug->save();

        $category->title = ($request->title==null ? $request->slug : $request->title);
        $category->media_id = ($request->media_id==null ? 1 : $request->media_id);
        $category->upper = $request->upper;
        $category->content = $request->content;
        $category->save();
        return redirect()->route('admin.category.edit',$id)->with(['type' => 'success', 'message' =>'Kategori Güncellendi.']);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $slug_id = Slug::findOrFail($category->slug_id);
        $category->delete();
        $slug_id->forceDelete();
        return redirect()->route('admin.category.index')->with(['type' => 'success', 'message' =>'Kategori Silindi.']);
    }
}

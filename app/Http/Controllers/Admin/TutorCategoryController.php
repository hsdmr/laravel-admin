<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Option;
use App\Models\Slug;

class TutorCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('type','=','tutor-category')->get();
        return view("admin.tutor.category.index",compact('categories'));
    }

    public function create()
    {
        $languages = Option::where('name','=','language')->get();
        $categories = Category::where('type','=','tutor-category')->get();
        return view("admin.tutor.category.create",compact('categories','languages'));
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
        $slug->owner = $request->type;;
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
        $category->type = $request->type;
        $category->language = $request->language;
        $category->save();
        return redirect()->route('admin.tutor.category.index')->with(['type' => 'success', 'message' =>'Category Saved.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all();
        $languages = Option::where('name','=','language')->get();
        return view('admin.tutor.category.edit',compact('category','categories','languages'));
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

        $slug->owner = $request->type;;
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
        $category->type = $request->type;
        $category->language = $request->language;
        $category->save();
        return redirect()->route('admin.tutor.category.edit',$id)->with(['type' => 'success', 'message' =>'Category Updated.']);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $slug_id = Slug::findOrFail($category->slug_id);
        $category->delete();
        $slug_id->forceDelete();
        return redirect()->route('admin.tutor.category.index')->with(['type' => 'success', 'message' =>'Category Deleted.']);
    }
}

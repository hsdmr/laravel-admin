<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Slug;
use App\Models\File;
use App\Models\Option;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.page.index',compact('pages'));
    }

    public function create()
    {
        $languages = Option::where('name','=','language')->get();
        return view('admin.page.create',compact('languages'));
    }

    public function store(Request $request)
    {
        $slug = new Slug;
        if($request->slug==null){
            $slug_last = $slug->latest()->first()->id+1;
            $request->slug = "page-".$slug_last;
        }else{
            $slug_check = Slug::withTrashed()->where('slug', '=', $request->slug)->first();
            if($slug_check!=null) $request->slug = $request->slug."-".uniqid();
        }
        $slug->owner = 'page';
        $slug->slug = $request->slug;
        $slug->seo_title = $request->seo_title;
        $slug->seo_description = $request->seo_description;
        $slug->no_index = ($request->no_index==null ? 0 : 1);
        $slug->no_follow = ($request->no_follow==null ? 0 : 1);
        $slug->save();

        $page = new page();
        $page->slug_id = $slug->id;
        $page->media_id = ($request->media_id==null ? 1 : $request->media_id);
        $page->title = ($request->title==null ? $request->slug : $request->title);
        $page->content = $request->content;
        $page->template = $request->template;
        $page->sidebar = $request->sidebar;
        $page->language = $request->language;
        $page->save();

        return redirect()->route('admin.page.edit',$page->id)->with(['type' => 'success', 'message' =>'Page Created.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $languages = Option::where('name','=','language')->get();
        return view('admin.page.edit',compact('page','languages'));
    }

    public function update(Request $request, $id)
    {
        if(isset($request->form)){
            $page = Page::find($id);
            $slug = Slug::find($page->slug_id);

            if($request->slug==null){
                $slug_last = $slug->latest()->first()->id+1;
                $request->slug = "page-".$slug_last;
            }else{
                $slug_check = Slug::withTrashed()->where('slug', '=', $request->slug)->first();
                if($slug_check!=null){
                    if($slug_check->id!=$page->slug_id) $request->slug = $request->slug."-".uniqid();
                }
            }
            $slug->owner = 'page';
            $slug->slug = $request->slug;
            $slug->seo_title = $request->seo_title;
            $slug->seo_description = $request->seo_description;
            $slug->no_index = ($request->no_index==null ? 0 : 1);
            $slug->no_follow = ($request->no_follow==null ? 0 : 1);
            $slug->save();

            $page->slug_id = $slug->id;
            $page->media_id = ($request->media_id==null ? 1 : $request->media_id);
            $page->title = ($request->title==null ? $request->slug : $request->title);
            $page->content = $request->content;
            $page->template = $request->template;
            $page->sidebar = $request->sidebar;
            $page->language = $request->language;
            $page->save();

            return redirect()->route('admin.page.edit',$id)->with(['type' => 'success', 'message' =>'Page Updated.']);
        };
    }

    public function delete($id)
    {
        $page = Page::find($id);
        Slug::find($page->slug_id)->delete();
        $page->delete();
        return redirect()->route('admin.page.index')->with(['type' => 'success', 'message' =>'Page Moved To Recycle Bin.']);
    }

    public function trash()
    {
        $pages = Page::onlyTrashed()->get();
        return view('admin.page.trash',compact('pages'));
    }

    public function recover($id)
    {
        $page = Page::withTrashed()->find($id);
        Slug::withTrashed()->find($page->slug_id)->restore();
        $page->restore();
        return redirect()->route('admin.page.trash')->with(['type' => 'success', 'message' =>'Page Recovered.']);
    }

    public function destroy($id)
    {
        $page = Page::withTrashed()->find($id);
        $slug = Slug::withTrashed()->find($page->slug_id);
        $page->forceDelete();
        $slug->forceDelete();
        return redirect()->route('admin.page.trash')->with(['type' => 'error', 'message' =>'The Page Has Beed Deleted.']);
    }

    public function switch(Request $request)
    {
        $page = Page::find($request->id);
        $page->statu = $request->statu=="true" ? 1 : 0;
        $page->save();
        return $request->statu;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::get()->groupBy('menuname');
        return view('admin.option.menu.index',compact('menus'));
    }

    public function create(Request $request)
    {
        return view('admin.option.menu.create');
    }

    public function store(Request $request)
    {
        $menu = new Menu;
        $menu->position = $request->position==null? 0 : $request->position;
        $menu->menuname = $request->menuname;
        $menu->title = $request->title==null? '' : $request->title;
        $menu->link = $request->link==null? '#' : $request->link;
        $menu->icon = $request->icon==null? '' : $request->icon;
        $menu->parent = $request->parent==null? null : $request->parent;
        $menu->order = $request->order==null? 0 : $request->order;
        $menu->save();

        $menus = Menu::orderBy('order', 'asc')->where('menuname','=',$menu->menuname)->get();
        $pages = Page::where('status','=','1')->get();
        $categories = Category::all();
        $articles = Article::where('status','=','1')->get();
        return view('admin.option.menu.show',compact('menus','pages','categories','articles'))->with(['type' => 'success', 'message' =>'Menu Saved.']);
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        $menus = Menu::orderBy('order', 'asc')->where('menuname','=',$menu->menuname)->get();
        $pages = Page::where('status','=','1')->get();
        $categories = Category::all();
        $articles = Article::where('status','=','1')->get();
        return view('admin.option.menu.show',compact('menus','pages','categories','articles'));
    }

    public function edit($id)
    {
        $menu = Menu::find($id);
        $menus = Menu::orderBy('order', 'asc')->where('menuname','=',$menu->menuname)->get();
        $pages = Page::where('status','=','1')->get();
        $categories = Category::all();
        $articles = Article::where('status','=','1')->get();
        return view('admin.option.menu.edit',compact('menu','menus','pages','categories','articles'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        $menu->position = $request->position;
        $menu->menuname = $request->menuname;
        $menu->title = $request->title==null? '' : $request->title;
        $menu->link = $request->link==null? '#' : $request->link;
        $menu->icon = $request->icon==null? '' : $request->icon;
        $menu->parent = $request->parent==null? null : $request->parent;
        $menu->order = $request->order==null? 0 : $request->order;
        $menu->save();

        $menus = Menu::orderBy('order', 'asc')->where('menuname','=',$menu->menuname)->get();
        $pages = Page::where('status','=','1')->get();
        $categories = Category::all();
        $articles = Article::where('status','=','1')->get();
        return view('admin.option.menu.show',compact('menus','pages','categories','articles'))->with(['type' => 'success', 'message' =>'Menu Saved.']);
    }

    public function delete($id)
    {
        $menu = Menu::find($id);
        $menuname = $menu->menuname;
        $menuname = Menu::where('menuname','=',$menuname)->first();
        $menuname = $menuname->id;
        $menu->delete();
        return redirect()->route('admin.option.menu.show',$menuname)->with(['type' => 'success', 'message' =>'Menu Line Deleted.']);
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menus = Menu::where('menuname','=',$menu->menuname)->get();
        foreach($menus as $menu){
            $menu->forceDelete();
        }
        return redirect()->route('admin.option.menu.index')->with(['type' => 'error', 'message' =>'The Menu Has Been Deleted.']);
    }

    public function position(Request $request)
    {
        $menus = Menu::where('position','=',$request->pos)->get();
        foreach ($menus as $menu) {
            $menu->position = 0;
            $menu->save();
        }
        if($request->status){
            $menus = Menu::where('menuname','=',$request->name)->get();
            foreach ($menus as $menu) {
                $menu->position = $request->pos;
                $menu->save();
            }
        }
    }
}

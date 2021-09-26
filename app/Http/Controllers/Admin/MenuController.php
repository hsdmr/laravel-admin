<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Log;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use Throwable;

class MenuController extends Controller
{
    public function index()
    {
        try {
            $menus = Menu::get()->groupBy('menuname');
            return view('admin.option.menu.index',compact('menus'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'menu',
                'message' => 'Menus page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Menus page could not be loaded.']);
        }
    }

    public function create(Request $request)
    {
        try {
            return view('admin.option.menu.create');
        } catch (Throwable $th) {
            Log::create([
                'model' => 'menu',
                'message' => 'Menu create page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Menu create page could not be loaded.']);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'menuname' => 'required|min:3|max:255',
            'title' => 'required|min:3|max:255',
            'link' => 'required|min:3|max:255',
            'icon' => 'nullable',
            'parent' => 'nullable|numeric|min:1',
            'order' => 'nullable|numeric',
        ]);
        try {
            $menu = Menu::create([
                'position' => $request->position ?? 0,
                'menuname' => $request->menuname,
                'title' => $request->title,
                'link' => $request->link ?? '#',
                'icon' => $request->icon ?? '',
                'parent' => $request->parent ?? null,
                'order' => $request->order ?? 0,
            ]);
            return redirect()->route('admin.option.menu.show', $menu)->with(['type' => 'success', 'message' =>'Menu item saved.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'menu',
                'message' => 'Menu item could not be stored.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Menu item could not be stored.']);
        }
    }

    public function show(Menu $menu)
    {
        try {
            $menus = Menu::orderBy('order', 'asc')->where('menuname','=',$menu->menuname)->get();
            $pages = Page::where('status','=','1')->get();
            $categories = Category::all();
            $articles = Article::where('status','=','1')->get();
            return view('admin.option.menu.show',compact('menus','pages','categories','articles'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'menu',
                'message' => 'Menu show page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Menu show could not be loaded.']);
        }
    }

    public function edit(Menu $menu)
    {
        try {
            $menus = Menu::orderBy('order', 'asc')->where('menuname','=',$menu->menuname)->get();
            $pages = Page::where('status','=','1')->get();
            $categories = Category::all();
            $articles = Article::where('status','=','1')->get();
            return view('admin.option.menu.edit',compact('menu','menus','pages','categories','articles'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'menu',
                'message' => 'Menu edit page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Menu edit page could not be loaded.']);
        }
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'menuname' => 'required|min:3|max:255',
            'title' => 'required|min:3|max:255',
            'link' => 'required|min:3|max:255',
            'icon' => 'nullable',
            'parent' => 'nullable|numeric|min:1',
            'order' => 'nullable|numeric',
        ]);
        try {
            $menu->update([
                'position' => $request->position ?? 0,
                'menuname' => $request->menuname,
                'title' => $request->title,
                'link' => $request->link ?? '#',
                'icon' => $request->icon ?? '',
                'parent' => $request->parent ?? null,
                'order' => $request->order ?? 0,
            ]);
            return redirect()->route('admin.option.menu.show', $menu)->with(['type' => 'success', 'message' =>'Menu item updated.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'menu',
                'message' => 'Menu item could not be updated.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Menu item could not be updated.']);
        }
    }

    public function menuName(Request $request)
    {
        $request->validate([
            'menuname' => 'required|min:3|max:255'
        ]);
        try {
            $menu = Menu::create([
                'position' => $request->position ?? 0,
                'menuname' => $request->menuname,
                'title' => $request->title,
                'link' => $request->link ?? '#',
                'icon' => $request->icon ?? '',
                'parent' => $request->parent ?? null,
                'order' => $request->order ?? 0,
            ]);
            return redirect()->route('admin.option.menu.show')->with(['type' => 'success', 'message' =>'Menu created.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'menu',
                'message' => 'Menu could not be created.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Menu could not be created.']);
        }
    }

    public function delete(Menu $menu)
    {
        try {
            $menuname = Menu::where('menuname','=',$menu->menuname)->first()->id;
            $menu->delete();
            return redirect()->route('admin.option.menu.show',$menuname)->with(['type' => 'success', 'message' =>'Menu item deleted.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'menu',
                'message' => 'Menu item could not be deleted.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Menu item could not be deleted.']);
        }
    }

    public function destroy(Menu $menu)
    {
        $menus = Menu::where('menuname','=',$menu->menuname)->get();
        foreach($menus as $menu){
            $menu->forceDelete();
        }
        return redirect()->route('admin.option.menu.index')->with(['type' => 'error', 'message' =>'The menu has been deleted.']);
        try {
            $menus = Menu::get()->groupBy('menuname');
            return view('admin.option.menu.index',compact('menus'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'menu',
                'message' => 'The menu could not be deleted.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'The menu could not be deleted.']);
        }
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

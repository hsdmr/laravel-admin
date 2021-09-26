<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slug;
use App\Models\Log;
use App\Models\Option;
use Throwable;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::where('type', '=', 'article-category')->get();
            return view("admin.category.index", compact('categories'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'category',
                'message' => 'Categories page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'Categories page could not be loaded.']);
        }
    }

    public function create()
    {
        try {
            $categories = Category::all();
            $languages = Option::where('name', '=', 'language')->get();
            return view("admin.category.create", compact('categories', 'languages'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'category',
                'message' => 'The category create page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'The category create page could not be loaded.']);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255',
            'language' => 'required',
            'no_index' => 'nullable|in:on',
            'no_follow' => 'nullable|in:on',
            'media_id' => 'nullable|numeric|min:1',
            'upper' => 'nullable|numeric',
            'type' => 'required',
        ]);
        try {
            $slug = Slug::create([
                'slug' => slugCheck($request->slug),
                'owner' => $request->type,
                'seo_title' => $request->seo_title,
                'seo_description' => $request->seo_description,
                'no_index' => $request->no_index == 'on' ? 1 : 0,
                'no_follow' => $request->no_follow == 'on' ? 1 : 0,
            ]);

            Category::create([
                'title' => $request->title,
                'slug_id' => $slug->id,
                'media_id' => $request->media_id ?? 1,
                'upper' => $request->upper,
                'content' => $request->content,
                'type' => $request->type,
                'language' => $request->language,
            ]);

            return redirect()->route('admin.category.index')->with(['type' => 'success', 'message' => 'Category Saved.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'category',
                'message' => 'The category could not be saved.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'The category could not be saved.']);
        }
    }

    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            $categories = Category::all();
            $languages = Option::where('name', '=', 'language')->get();
            return view('admin.category.edit', compact('category', 'categories', 'languages'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'category',
                'message' => 'The category edit page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'The category edit page could not be loaded.']);
        }
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255',
            'language' => 'required',
            'no_index' => 'nullable|in:on',
            'no_follow' => 'nullable|in:on',
            'media_id' => 'nullable|numeric|min:1',
            'upper' => 'nullable|numeric',
            'type' => 'required',
        ]);
        try {
            $category->getSlug()->update([
                'slug' => slugCheck($request->slug, $category->slug_id),
                'owner' => $request->type,
                'seo_title' => $request->seo_title,
                'seo_description' => $request->seo_description,
                'no_index' => $request->no_index == 'on' ? 1 : 0,
                'no_follow' => $request->no_follow == 'on' ? 1 : 0,
            ]);

            $category->update([
                'title' => $request->title,
                'media_id' => $request->media_id ?? 1,
                'upper' => $request->upper,
                'content' => $request->content,
                'type' => $request->type,
                'language' => $request->language,
            ]);

            return redirect()->route('admin.category.edit', $category->id)->with(['type' => 'success', 'message' => 'Category Updated.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'category',
                'message' => 'The category could not be updated.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'The category could not be updated.']);
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->getSlug()->forceDelete();
            $category->delete();
            return redirect()->route('admin.category.index')->with(['type' => 'success', 'message' => 'Category Deleted.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'category',
                'message' => 'The category could not be destroyed.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'The category could not be destroyed.']);
        }
    }
}

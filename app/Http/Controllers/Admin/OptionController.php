<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Option;
use App\Models\Widget;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index()
    {
        $option = [];
        foreach (Option::where('key', 'LIKE', 'OP_%')->get() as $op) {
            $option[$op->key] = $op->value;
        }
        return view('admin.option.index', compact('option'));
    }

    public function update(Request $request)
    {
        foreach ($request->except(['_token']) as $key => $value) {
            if ($key == 'logo' || $key == 'favicon') {
                $option = Option::where('key', 'OP_' . $key)->first();
                $option != null ? $option->update(['value' => $value ?? 1]) : Option::create(['key' => 'OP_' . $key, 'value' => $value ?? 1]);
            } else if ($key == 'no_index' || $key == 'no_follow') {
                $option = Option::where('key', 'OP_' . $key)->first();
                $option != null ? $option->update([$key => isset($value) ? 1 : 0]) : Option::create(['key' => 'OP_' . $key, 'value' => isset($value) ? 1 : 0]);
            } else {
                $option = Option::where('key', 'OP_' . $key)->first();
                $option != null ? $option->update([$key => $value]) : Option::create(['key' => 'OP_' . $key, 'value' => $value]);
            }
        }

        return redirect()->route('admin.option.index')->with(['type' => 'success', 'message' => 'Options Saved.']);
    }

    public function contact()
    {
        $contact = Option::where('key', '=', 'contact')->where('language', '=', 'tr')->first();
        $contact = $contact != null ? unserialize($contact->value) : [];
        return view('admin.option.contact', compact('contact'));
    }

    public function contactUpdate(Request $request)
    {
        $contact = Option::where('key', '=', 'contact')->where('language', '=', $request->language)->first();
        $contact != null ? $contact->update(['value' => serialize($request->contact)]) : $contact = Option::create(['key' => 'contact', 'value' => serialize($request->contact), 'language' => $request->language]);
        $contact = unserialize($contact->value);
        return redirect()->route('admin.option.contact')->with(['type' => 'success', 'message' => 'Contact Information Saved.']);
    }

    public function social(Request $request)
    {
        $socials = Option::where('key', '=', 'OP_social')->where('language', '=', 'tr')->first();
        $socials != null ? $socials = unserialize($socials->value) : $socials = [];
        return view('admin.option.social', compact('socials'));
    }

    public function socialUpdate(Request $request)
    {
        $socials = Option::where('key', '=', 'social')->where('language', '=', $request->language)->first();
        $socials != null ? $socials->update(['value' => serialize($request->social)]) : $socials = Option::create(['key' => 'social', 'value' => serialize($request->social), 'language' => $request->language]);
        $socials = unserialize($socials->value);
        return redirect()->route('admin.option.social', compact('socials'))->with(['type' => 'success', 'message' => 'Social Media Accounts Saved.']);
    }

    public function widget()
    {
        $menus = Menu::get()->groupBy('menuname');
        $widgets = Widget::all();
        return view('admin.option.widget', compact('widgets', 'menus'));
    }

    public function widgetUpdate(Request $request)
    {
        // should improve
        $widget = Widget::find($request->id);
        if ($request->id == 1) {
            $widget->title = $request->title1;
            $widget->menu = $request->menu1;
            $widget->content = $request->content1;
        }
        if ($request->id == 2) {
            $widget->title = $request->title2;
            $widget->menu = $request->menu2;
            $widget->content = $request->content2;
        }
        if ($request->id == 3) {
            $widget->title = $request->title3;
            $widget->menu = $request->menu3;
            $widget->content = $request->content3;
        }
        if ($request->id == 4) {
            $widget->title = $request->title4;
            $widget->menu = $request->menu4;
            $widget->content = $request->content4;
        }
        $widget->save();
        return redirect()->route('admin.option.widget')->with(['type' => 'success', 'message' => 'Footer ' . $request->id . ' Saved.']);
    }
}

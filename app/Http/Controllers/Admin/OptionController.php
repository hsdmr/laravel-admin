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
        $option = Option::find(1);
        return view('admin.option.index',compact('option'));
    }

    public function update(Request $request)
    {
        $option = Option::find(1);
        $option->title = $request->title;
        $option->logo = $request->logo;
        $option->favicon = $request->favicon;
        $option->headcss = $request->headcss;
        $option->headjs = $request->headjs;
        $option->footerjs = $request->footerjs;
        $option->save();

        return redirect()->route('admin.option.index')->with(['type' => 'success', 'message' =>'Options Saved.']);
    }

    public function contact()
    {
        $contact = Option::where('name','=','contact')->where('language','=','tr')->first();
        if(isset($contact)) $contact = unserialize($contact->value);
        else $contact = [];
        //dd($contact);
        return view('admin.option.contact',compact('contact'));
    }

    public function contactUpdate(Request $request)
    {
        $contact = Option::where('name','=','contact')->where('language','=',$request->language)->first();
        if(isset($contact)){
            $contact->value = serialize($request->contact);
            $contact->save();
        }
        else{
            $contact = new Option();
            $contact->name = 'contact';
            $contact->value = serialize($request->contact);
            $contact->language = $request->language;
            $contact->save();
        }
        $contact = unserialize($contact->value);
        return redirect()->route('admin.option.contact')->with(['type' => 'success', 'message' =>'Contact Information Saved.']);
    }

    public function social(Request $request)
    {
        $social = Option::where('name','=','social')->where('language','=','tr')->first();
        if(isset($social)) $socials = unserialize($social->value);
        else $socials = [];
        return view('admin.option.social',compact('socials'));
    }

    public function socialUpdate(Request $request)
    {
        $social = Option::where('name','=','social')->where('language','=',$request->language)->first();
        if(isset($social)){
            $social->value = serialize($request->social);
            $social->save();
        }
        else{
            $social = new Option();
            $social->name = 'social';
            $social->value = serialize($request->social);
            $social->language = $request->language;
            $social->save();
        }
        $socials = unserialize($social->value);
        return redirect()->route('admin.option.social',compact('socials'))->with(['type' => 'success', 'message' =>'Social Media Accounts Saved.']);
    }

    public function widget()
    {
        $menus = Menu::get()->groupBy('menuname');
        $widgets = Widget::all();
        return view('admin.option.widget',compact('widgets','menus'));
    }

    public function widgetUpdate(Request $request)
    {
        $widget = Widget::find($request->id);
        if($request->id==1){
            $widget->title = $request->title1;
            $widget->menu = $request->menu1;
            $widget->content = $request->content1;
        }
        if($request->id==2){
            $widget->title = $request->title2;
            $widget->menu = $request->menu2;
            $widget->content = $request->content2;
        }
        if($request->id==3){
            $widget->title = $request->title3;
            $widget->menu = $request->menu3;
            $widget->content = $request->content3;
        }
        if($request->id==4){
            $widget->title = $request->title4;
            $widget->menu = $request->menu4;
            $widget->content = $request->content4;
        }
        $widget->save();
        return redirect()->route('admin.option.widget')->with(['type' => 'success', 'message' =>'Footer '.$request->id.' Saved.']);

    }

}

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
        $option = [
            'logo' => Option::where('name','=','logo')->first()->value,
            'favicon' => Option::where('name','=','favicon')->first()->value,
            'title' => Option::where('name','=','title')->first()->value,
            'headcss' => Option::where('name','=','headcss')->first()->value,
            'headjs' => Option::where('name','=','headjs')->first()->value,
            'footerjs' => Option::where('name','=','footerjs')->first()->value,
            'no_index' => Option::where('name','=','no_index')->first()->value,
            'no_follow' => Option::where('name','=','no_follow')->first()->value,
        ];
        return view('admin.option.index',compact('option'));
    }

    public function update(Request $request)
    {
        $option = Option::where('name','=','logo')->first();
        $option->value = $request->logo;
        $option->save();
        $option = Option::where('name','=','favicon')->first();
        $option->value = $request->favicon;
        $option->save();
        $option = Option::where('name','=','title')->first();
        $option->value = $request->title;
        $option->save();
        $option = Option::where('name','=','headcss')->first();
        $option->value = $request->headcss;
        $option->save();
        $option = Option::where('name','=','headjs')->first();
        $option->value = $request->headjs;
        $option->save();
        $option = Option::where('name','=','footerjs')->first();
        $option->value = $request->footerjs;
        $option->save();
        $option = Option::where('name','=','no_index')->first();
        $option->value = isset($request->no_index)? 1 : 0;
        $option->save();
        $option = Option::where('name','=','no_follow')->first();
        $option->value = isset($request->no_follow)? 1 : 0;
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

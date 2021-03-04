<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\File;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\Social;
use App\Models\Widget;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1);
        return view('admin.setting.index',compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::find(1);
        $setting->title = $request->title;
        $setting->logo = $request->logo;
        $setting->favicon = $request->favicon;
        $setting->headcss = $request->headcss;
        $setting->headjs = $request->headjs;
        $setting->footerjs = $request->footerjs;
        $setting->save();

        return redirect()->route('admin.setting.index')->with(['type' => 'success', 'message' =>'Settings Saved.']);
    }

    public function contact()
    {
        $contact = Contact::find(1);
        return view('admin.setting.contact',compact('contact'));
    }

    public function contactUpdate(Request $request)
    {
        $contact = Contact::find(1);
        $contact->cell = $request->cell;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->address = $request->address;
        $contact->map = $request->map;
        $contact->latitude = $request->latitude;
        $contact->langitude = $request->langitude;
        $contact->zoom = $request->zoom;
        $contact->save();

        return redirect()->route('admin.setting.contact')->with(['type' => 'success', 'message' =>'Contact Information Saved.']);
    }

    public function social()
    {
        $social = Social::find(1);
        return view('admin.setting.social',compact('social'));
    }

    public function socialUpdate(Request $request)
    {
        $social = Social::find(1);
        $social->behance = $request->behance;
        $social->dribble = $request->dribble;
        $social->facebook = $request->facebook;
        $social->github = $request->github;
        $social->flickr = $request->flickr;
        $social->instagram = $request->instagram;
        $social->linkedin = $request->linkedin;
        $social->pinterest = $request->pinterest;
        $social->reddit = $request->reddit;
        $social->skype = $request->skype;
        $social->soundcloud = $request->soundcloud;
        $social->tumblr = $request->tumblr;
        $social->twitter = $request->twitter;
        $social->vimeo = $request->vimeo;
        $social->vk = $request->vk;
        $social->xing = $request->xing;
        $social->yelp = $request->yelp;
        $social->youtube = $request->youtube;
        $social->whatsapp = $request->whatsapp;
        $social->email = $request->email;
        $social->save();

        return redirect()->route('admin.setting.social')->with(['type' => 'success', 'message' =>'Social Media Accounts Saved.']);
    }

    public function widget()
    {
        $menus = Menu::get()->groupBy('menuname');
        $widgets = Widget::all();
        return view('admin.setting.widget',compact('widgets','menus'));
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
        return redirect()->route('admin.setting.widget')->with(['type' => 'success', 'message' =>'Footer '.$request->id.' Saved.']);

    }

}

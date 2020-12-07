<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\File;
use App\Models\Setting;
use App\Models\Suspend;
use App\Models\Widget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.layouts.master',function($view){
            $view->with([
                'auth'=>Auth::user(),
                ]);
        });
        view()->composer('admin.layouts.media',function($view){
            $view->with('medias',File::orderBy('created_at', 'desc')->where('collection','=','default')->simplePaginate(80));
        });
        view()->composer('layouts.master',function($view){
            $view->with([
                'widget' => Widget::all(),
                'setting' => Setting::find(1),
                ]);
        });
    }
}

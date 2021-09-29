<?php

namespace App\Providers;

use App\Models\File;
use App\Models\Option;
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
                'languages' => Option::where('key','=','language')->get(),
                ]);
        });
        view()->composer('admin.layouts.media',function($view){
            $view->with('medias',File::orderBy('created_at', 'desc')->where('collection','=','default')->simplePaginate(80));
        });
        view()->composer('layouts.master',function($view){
            $option = [
                'no_index' => Option::where('key','=','no_index')->first()->value,
                'no_follow' => Option::where('key','=','no_follow')->first()->value,
                'logo' => Option::where('key','=','logo')->first()->value,
                'favicon' => Option::where('key','=','favicon')->first()->value,
                'headcss' => Option::where('key','=','headcss')->first()->value,
                'headjs' => Option::where('key','=','headjs')->first()->value,
                'footerjs' => Option::where('key','=','footerjs')->first()->value,

            ];
            $view->with([
                'widget' => Widget::all(),
                'option' => $option,
                'languages' => Option::where('key','=','language')->get(),
                ]);
        });
    }
}

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
                ]);
        });
        view()->composer('admin.layouts.media',function($view){
            $view->with('medias',File::orderBy('created_at', 'desc')->where('collection','=','default')->simplePaginate(80));
        });
        view()->composer('layouts.master',function($view){
            $option = [
                'no_index' => Option::where('name','=','no_index')->first()->value,
                'no_follow' => Option::where('name','=','no_follow')->first()->value,
                'logo' => Option::where('name','=','logo')->first()->value,
                'favicon' => Option::where('name','=','favicon')->first()->value,
                'headcss' => Option::where('name','=','headcss')->first()->value,
                'headjs' => Option::where('name','=','headjs')->first()->value,
                'footerjs' => Option::where('name','=','footerjs')->first()->value,

            ];
            $view->with([
                'widget' => Widget::all(),
                'option' => $option,
                ]);
        });
    }
}

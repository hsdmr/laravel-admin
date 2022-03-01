<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class OptionSeeder extends Seeder
{
    public function run()
    {
        $options = ['logo','favicon','title','headcss','headjs','footerjs','no_index','no_follow'];
        foreach($options as $option){
            $opt = new Option();
            $opt->key = $option;
            $opt->language = 'tr';
            $opt->save();
        }
        $option = Option::where('key','=','logo')->first();
        $option->value = 1;
        $option->save();
        $option = Option::where('key','=','favicon')->first();
        $option->value = 1;
        $option->save();

        $opt = new Option();
        $opt->key = 'language';
        $opt->value = 'Türkçe';
        $opt->language = 'tr';
        $opt->save();
        $opt = new Option();
        $opt->key = 'language';
        $opt->value = 'English';
        $opt->language = 'en';
        $opt->save();
    }
}

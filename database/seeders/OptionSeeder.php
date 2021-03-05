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
            $opt->name = $option;
            $opt->language = App::currentLocale();
            $opt->save();
        }
    }
}

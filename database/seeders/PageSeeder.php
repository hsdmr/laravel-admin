<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Slug;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run()
    {
        $pages = ['Anasayfa','Blog','İletişim'];
        foreach($pages as $page){
            $slug = new Slug();
            $slug->slug = Str::slug($page);
            $slug->owner = 'page';
            $slug->save();
            $pag = new Page;
            $pag->title = $page;
            $pag->slug_id = $slug->id;
            $pag->media_id = 1;
            $pag->statu = 1;
            $pag->template = Str::slug($page);
            $pag->save();
        }
    }
}

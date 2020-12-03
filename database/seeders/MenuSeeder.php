<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menu = new Menu;
        $menu->menuname = 'Ana Menu';
        $menu->position = 1;
        $menu->save();
        $menu = new Menu;
        $menu->menuname = 'Ana Menu';
        $menu->title = 'Blog';
        $menu->link = 'blog';
        $menu->order = 1;
        $menu->position = 1;
        $menu->save();
        $menu = new Menu;
        $menu->menuname = 'Ana Menu';
        $menu->title = 'İletişim';
        $menu->link = 'iletisim';
        $menu->order = 2;
        $menu->position = 1;
        $menu->save();
        $menu = new Menu;
        $menu->menuname = 'Footer';
        $menu->save();
    }
}

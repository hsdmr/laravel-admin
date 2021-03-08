<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(FileSeeder::class);
        //$this->call(CategorySeeder::class);
        //$this->call(SocialSeeder::class);
        //$this->call(MenuSeeder::class);
        //$this->call(PageSeeder::class);
        //$this->call(WidgetSeeder::class);
        $this->call(OptionSeeder::class);
    }
}

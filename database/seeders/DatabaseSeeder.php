<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(FileSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SocialSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(WidgetSeeder::class);
        $this->call(OptionSeeder::class);

        User::create([
            'email' => 'hasdemir@gmail.com',
            'password' => Hash::make(12345678),
            'role' => 'admin'
        ]);
    }
}

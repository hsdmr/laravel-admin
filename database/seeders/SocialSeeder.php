<?php

namespace Database\Seeders;

use App\Models\Social;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    public function run()
    {
        $social = new Social;
        $social->instagram = 'https://www.instagram.com/hsdmrsoft/';
        $social->save();
    }
}

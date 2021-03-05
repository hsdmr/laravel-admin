<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    public function run()
    {

        $social = new Option();
        $social->instagram = 'https://www.instagram.com/hsdmrsoft/';
        $social->github = 'https://github.com/hsdmr';
        $social->linkedin = 'https://www.linkedin.com/in/murat-hasdemir-466a4a198/';
    }
}

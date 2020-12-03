<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    public function run()
    {
        $file = new File;
        $file->create()->addMedia(public_path('admin/img/empty.png'))->preservingOriginal()->toMediaCollection();
    }
}

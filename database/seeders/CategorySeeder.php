<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Slug;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Unnamed','Articles','Videos'];
        foreach($categories as $category){
            $slug = new Slug();
            $slug->slug = Str::slug($category);
            $slug->owner = 'category';
            $slug->save();
            $cat = new Category;
            $cat->title = $category;
            $cat->type = 'article-category';
            $cat->slug_id = $slug->id;
            $cat->media_id = 1;
            $cat->save();
        }
    }
}

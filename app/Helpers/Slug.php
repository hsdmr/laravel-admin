<?php

use App\Models\Slug;

if (!function_exists('menuOrder')) {
    function slugCheck($slug, $model = null): string
    {
        $slug_check = Slug::withTrashed()->where('slug', '=', $slug)->first();
        if ($slug_check != null) {
            if ($model != null) {
                if ($slug_check->id == $model->slug_id) {
                    return $slug;
                }
            }
            $slug = $slug . "-" . uniqid();
        }
        return $slug;
    }
}

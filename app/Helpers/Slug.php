<?php

use App\Models\Slug;

if (!function_exists('slugCheck')) {
    function slugCheck($slug, $slug_id = null): string
    {
        $slug_check = Slug::withTrashed()->where('slug', '=', $slug)->first();
        if ($slug_check != null) {
            if ($slug_id != null) {
                if ($slug_check->id == $slug_id) {
                    return $slug;
                }
            }
            $slug = $slug . "-" . uniqid();
        }
        return $slug;
    }
}

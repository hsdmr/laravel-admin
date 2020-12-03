<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    function getSlug(){
        return $this->hasOne('App\Models\Slug','id','slug_id');
    }
    function getMedia(){
        return $this->hasOne('App\Models\Media','id','media_id');
    }
}

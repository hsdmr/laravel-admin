<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    function getTopics(){
        return $this->hasMany('App\Models\Lesson');
    }
    function getMedia(){
        return $this->hasOne('App\Models\Media','id','media_id');
    }
    function getSlug(){
        return $this->hasOne('App\Models\Slug','id','slug_id');
    }
    function getCategory(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }

}

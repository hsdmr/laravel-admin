<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    function getLessons(){
        return $this->hasMany('App\Models\Lesson');
    }
    function getMedia(){
        return $this->hasOne('App\Models\Media','id','media_id');
    }
}

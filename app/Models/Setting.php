<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    function getLogo(){
        return $this->hasOne('App\Models\Media','id','logo');
    }
    function getFavicon(){
        return $this->hasOne('App\Models\Media','id','favicon');
    }
}

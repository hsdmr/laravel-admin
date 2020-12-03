<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    function getArticle(){
        return $this->belongsTo('App\Models\Article','article_id','id');
    }
    function getUser(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}

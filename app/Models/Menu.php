<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    function parent()
    {
        return $this->belongsTo('App\Models\Menu', 'parent');
    }

    function children()
    {
        return $this->hasMany('App\Models\Menu', 'parent');
    }
}

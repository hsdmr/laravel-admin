<?php

namespace App\Http\Controllers;

use App\Models\UserMeta;
use Illuminate\Http\Request;

class TryController extends Controller
{
    public function try(){
        $try = UserMeta::select('user_id','key','value')->where('user_id','=',1)->get();
        foreach($try as $tr){
            $try_json[$tr->key] = $tr->value;
        }
        dd($try_json);
    }
}

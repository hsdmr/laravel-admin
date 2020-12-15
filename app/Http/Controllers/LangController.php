<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function lang($lang){
        session(['lang' => $lang]);
        return redirect()->back();
    }
}

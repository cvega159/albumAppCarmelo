<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\IndexController;

class IndexController extends Controller
{
    function about(){
        return view('base.about');
    }
}

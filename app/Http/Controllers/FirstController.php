<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirstController extends Controller
{
    public function first(){
        // return "hello";
        return view('electronics');
    }
}

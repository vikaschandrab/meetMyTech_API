<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VikasProfileController extends Controller
{
    public function homePage(){
        return view('vikas.vikas');
    }
}

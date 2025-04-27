<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VikasProfileController extends Controller
{
    public function homePage(){
        $designs = ['Vikas.Design_1', 'Vikas.Design_2']; // Put your blade views here
        $randomDesign = $designs[array_rand($designs)];   // Pick one randomly

        return view($randomDesign);
    }
}

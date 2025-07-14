<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExperianceController extends Controller
{
    public function index(){
        return view('Users.Pages.experiance');
    }
}

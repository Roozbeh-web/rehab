<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getSignIn(){
        return view('signin');
    }

    public function postSignIn(){
        return view('signin');
    }
}

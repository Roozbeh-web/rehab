<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getSignIn(){
        return view('signin');
    }

    public function postSignIn(Request $request){
        dd($request);
    }

    public function getSignUp(){
        return view('signup');
    }

    public function postSignUp(Request $request){

    }
}

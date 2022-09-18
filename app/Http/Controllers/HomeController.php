<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::viaRemember() || auth()->id()){
            return redirect('/dashboard');
        }
        return view('home');
    }
}

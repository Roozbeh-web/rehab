<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function leadersPlan(){
        return view('leaders-plans');
    }
}

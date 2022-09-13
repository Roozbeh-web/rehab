<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPosts(){
        return view('posts');
    }

    public function getEditPost(){
        return view('editPost');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function showForm()
    {
        return Inertia::render('post.postForm');
        //return view('post.postForm'); 
    }
}
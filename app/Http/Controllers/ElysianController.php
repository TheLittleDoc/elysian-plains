<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElysianController extends Controller
{
    public function index()
    {
        $post = \App\Models\Post::all();
        $post->sortByDesc('created_at');

        return view('home', ['posts' => $post]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // redirect to home
        return redirect('/');
    }

    // show individual post
    public function show (Post $post)
    {
        if($post->published == 0)
        {
            // 404
            if(!auth()->user() || !auth()->user()->isAdmin())
                abort(404);

        }
        return view('posts.post', compact('post'));
    }


    public function store(Request $request)
    {

        if(!auth()->user())
        {
            return redirect('/')->with('failure', 'You must be logged in to create posts.');
        }
        // popup alert
        if (auth()->user()->isAdmin()) {
            $message = "You are an admin and can create posts. (Admin ID: " . auth()->id() . ")";
        } else {

            $message = "You are not an admin and cannot create posts. (User ID: " . auth()->id() . ")";
            return redirect('/')->with('failure', 'You are not authorized to create posts.');
        }
        echo "<script type='text/javascript'>alert('$message');</script>";

        $post = Post::create();

        return redirect('/posts/' . $post['id'] . '/edit')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        if(auth()->user())
        {
            if (auth()->user()->isAdmin()) {
                // We'll add authorization in lesson 11
                return view('posts.edit', compact('post'));
            } else {
                return redirect('/')->with('failure', 'You are not authorized to edit posts.');
            }
        }
        return redirect('/')->with('failure', 'You must be logged in to edit posts.');
    }

    public function update(Request $request, Post $post)
    {
        if (auth()->user()->isAdmin()) {
        // We'll add authorization in lesson 11
            $post->update($request->all());

            return redirect('/posts/' . $post['id'] . '/edit')->with('success', 'Post updated successfully!');
        } else {
            return redirect('/')->with('failure', 'You are not authorized to update posts.');
        }
    }

    public function destroy(Post $post)
    {
        //check if authenticated at all
        if (!auth()->user()) {
            return redirect('/')->with('failure', 'You must be logged in to delete posts.');
        }
        if (auth()->user()->isAdmin()) {
            $post->delete();

            return redirect('/')->with('success', 'Post deleted successfully!');
        } else {
            return redirect('/')->with('failure', 'You are not authorized to delete posts.');
        }
    }
}

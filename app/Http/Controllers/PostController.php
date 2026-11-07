<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

const POST_NOT_FOUND_MESSAGE = 'This post does not exist.';
const POST_NOT_PUBLISHED_MESSAGE = 'This post is not published.';
const POST_NOT_AUTHORIZED_MESSAGE = 'You are not authorized to manage posts.';

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

        if (!$post) {
            abort(404, POST_NOT_FOUND_MESSAGE);
        }

        if($post->published == 0)
        {
            // 404
            if(!auth()->user() || !auth()->user()->isAdmin())
                abort(404, POST_NOT_FOUND_MESSAGE);

        }
        return view('posts.post', compact('post'));
    }


    public function store(Request $request)
    {
        if(!auth()->user())
        {
            abort(404);
        }
        // popup alert
        if (!auth()->user()->isAdmin()) {
            abort(403, POST_NOT_AUTHORIZED_MESSAGE);
        }
        $post = Post::create([
            'title' => 'New Post',
            'content' => json_encode([
                [
                    "type" => "heading",
                    "value" => "Post #" . (Post::newest() + 1),
                    "level" => 1
                ],
                [
                    "type" => "paragraph",
                    "value" => "This is the content of the new post."
                ]
            ]),
            'user_id' => auth()->id(),
            'published' => 0,
        ]);

        $post->save();

        return redirect('/posts/' . $post['id'] . '/edit')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        if(auth()->user())
        {
            if (auth()->user()->isAdmin()) {
                // handle 404 for posts that don't exist
                if (!$post) {
                    abort(404, POST_NOT_FOUND_MESSAGE);
                }

                return view('posts.edit', compact('post'));
            } else {
                abort(403, POST_NOT_AUTHORIZED_MESSAGE);
            }
        }
        abort(404);
    }

    public function update(Request $request, Post $post)
    {
        if (auth()->user()->isAdmin()) {

            $post->update($request->all());

            return redirect('/posts/' . $post['id'] . '/edit')->with('success', 'Post updated successfully!');
        } else {
            abort(403, POST_NOT_AUTHORIZED_MESSAGE);
        }
    }

    public function destroy(Post $post)
    {
        //check if authenticated at all
        if (!auth()->user()) {
            abort(403, POST_NOT_AUTHORIZED_MESSAGE);
        }
        if (auth()->user()->isAdmin()) {
            $post->delete();

            return redirect('/')->with('success', 'Post deleted successfully!');
        } else {
            abort(403, POST_NOT_AUTHORIZED_MESSAGE);
        }
    }

    public function renderContent(Request $request)
    {
        $content = $request->input('content');
        $tempPost = [
            'title' => $request->input('title', 'Untitled Post'),
            'content' => $content,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        // Render the content using the renderer component
        try {
            $renderedContent = view('components.renderer', ['post' => $tempPost])->render();
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Failed to render content: ' . $e->getMessage(), 'Input' => $tempPost], 500);
        }
        if(!$renderedContent)
        {
            return response()->json(['error' => 'Failed to render content.'], 500);
        }
        return response(content: $renderedContent, status: 200);

    }
}

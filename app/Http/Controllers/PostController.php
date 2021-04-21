<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request as HttpRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function store(HttpRequest $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $request->user()->posts()->create($request->only('body'));

        return back();
    }
}

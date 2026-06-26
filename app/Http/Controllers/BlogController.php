<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::where('published', true)
            ->orderBy('published_at', 'desc')
            ->get();

        return view('blog.index', compact('posts'));
    }

    public function show(BlogPost $post)
    {
        $post->load([
            'likes',
            'comments.user',
        ]);

        return view('blog.show', compact('post'));
    }
}

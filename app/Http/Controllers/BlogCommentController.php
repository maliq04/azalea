<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function store(Request $request, BlogPost $post)
    {
        $validated = $request->validate([
            'body' => ['required', 'min:2', 'max:1000'],
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body'    => $validated['body'],
        ]);

        return redirect()->back()->withFragment('comments');
    }

    public function destroy(BlogComment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return redirect()->back()->withFragment('comments');
    }
}

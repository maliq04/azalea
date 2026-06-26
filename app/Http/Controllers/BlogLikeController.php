<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BlogLikeController extends Controller
{
    public function toggle(BlogPost $post): JsonResponse
    {
        $user = auth()->user();

        $existing = $post->likes()->where('user_id', $user->id)->first();

        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'count' => $post->likeCount(),
        ]);
    }
}

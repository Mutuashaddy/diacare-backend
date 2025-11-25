<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    // Get all replies for a post
    public function index($post_id)
    {
        $post = Post::find($post_id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $replies = Reply::where('post_id', $post_id)
                        ->with('user:id,name,email') // include user info
                        ->latest()
                        ->get();

        return response()->json([
            'status' => 200,
            'data' => $replies,
        ]);
    }

    // Store a reply
    public function store(Request $request, $post_id)
    {
        $request->validate([
            'reply_text' => 'required|string',
        ]);

        $post = Post::find($post_id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'post_id' => $post_id,
            'reply_text' => $request->reply_text,
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Reply added successfully',
            'data' => $reply->load('user:id,name,email'), // include user info in response
        ]);
    }
}

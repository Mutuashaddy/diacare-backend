<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
     //Display all posts
    
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $posts
        ], 200);
    }

    
     // Store a newly created post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'topic'   => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'topic'   => $validated['topic'],
            'message' => $validated['message'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'data'    => $post
        ], 201);
    }

    
     //Display one post
    
    public function show($id)
    {
        $post = Post::with('user')->find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $post
        ]);
    }

    
    // Update the specified post
     
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        // ensure user owns the post
        if ($post->user_id != Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'topic'   => 'sometimes|string|max:255',
            'message' => 'sometimes|string',
        ]);

        $post->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'data' => $post
        ]);
    }

    
    // Remove the specified post
     
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        if ($post->user_id != Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully'
        ]);
    }
}

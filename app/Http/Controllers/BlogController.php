<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Show all posts
    public function index()
    {
        // Fetch all posts and the associated users
        $posts = Post::with('user')->latest()->get();
        
        return view('blog.index', compact('posts'));
    }

    public function show($id,Request $request)
    {
      // Fetch the post along with its comments and the comment authors
    $post = Post::with('comments.user')->findOrFail($id);

    // Store the comment ID in the session for editing, if 'edit' query parameter exists
    if ($request->has('edit')) {
        session(['edit_comment_id' => $request->edit]);
    } else {
        session()->forget('edit_comment_id');
    }

    return view('blog.show', compact('post'));
    }
}


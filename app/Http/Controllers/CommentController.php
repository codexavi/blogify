<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CommentController extends Controller
{
    // Store a new comment
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        // Create a new comment
        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        // Clear cached comments for the post after adding a new comment
        Cache::forget("post_comments_{$post->id}");

        return redirect()->route('blog.show', $post->id)->with('success', 'Comment added successfully.');
    }

    // Update an existing comment
    public function update(Request $request, Comment $comment)
    {
        // Ensure the user is authorized to edit the comment
        if (Auth::id() !== $comment->user_id) {
            return redirect()->route('blog.show', $comment->post->id)->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'content' => 'required',
        ]);

        // Update the comment
        $comment->update([
            'content' => $request->content,
        ]);

        // Clear cached comments for the post after updating the comment
        Cache::forget("post_comments_{$comment->post->id}");

        return redirect()->route('blog.show', $comment->post->id)->with('success', 'Comment updated successfully.');
    }

    // Delete a comment
    public function destroy(Comment $comment)
    {
        // Ensure the user is authorized to delete the comment
        if (Auth::id() !== $comment->user_id) {
            return redirect()->route('blog.show', $comment->post->id)->with('error', 'Unauthorized access.');
        }

        // Delete the comment
        $comment->delete();

        // Clear cached comments for the post after deleting the comment
        Cache::forget("post_comments_{$comment->post->id}");

        return redirect()->route('blog.show', $comment->post->id)->with('success', 'Comment deleted successfully.');
    }
}

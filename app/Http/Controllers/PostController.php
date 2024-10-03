<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    // List posts for regular users (only their posts)
    public function index()
    {
        // Use caching and eager load comments for each post
        $posts = Cache::remember('user_posts_' . Auth::id(), 600, function () {
            return Post::where('user_id', Auth::id())->with('comments')->get(); // Eager load comments
        });

        // Cache trashed posts
        $trashedPosts = Cache::remember('trashed_user_posts_' . Auth::id(), 600, function () {
            return Post::onlyTrashed()->where('user_id', Auth::id())->with('comments')->get();  // Eager load comments
        });

        return view('posts.index', compact('posts', 'trashedPosts'));
    }

    // List all posts for admins
    public function adminIndex()
    {
        // Use caching and eager load comments for each post
        $posts = Cache::remember('admin_posts', 600, function () {
            return Post::with('comments')->get();  // Admin can see all posts with comments
        });

        return view('admin.posts.index', compact('posts'));
    }

    public function create() {

         return view('posts.create');
     }

    // Create a new post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        // Create the post
        Auth::user()->posts()->create($validated);

        // Clear the cache after creating a new post
        Cache::forget('user_posts_' . Auth::id());
        Cache::forget('admin_posts');  // Also clear admin posts cache if applicable

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // Edit a post
    public function edit(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        return view('posts.edit', compact('post'));
    }

    // Update a post
    public function update(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        // Update the post
        $post->update($validated);

        // Clear the cache after updating a post
        Cache::forget('user_posts_' . Auth::id());
        Cache::forget('admin_posts');  // Clear admin cache

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // Soft delete a post
    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized action.');
        }

        // Soft delete the post
        $post->delete();

        // Clear the cache after deleting a post
        Cache::forget('user_posts_' . Auth::id());
        Cache::forget('admin_posts');  // Clear admin cache
        Cache::forget('trashed_user_posts_' . Auth::id());

        return redirect()->route('posts.index')->with('success', 'Post soft deleted.');
    }

    // Restore a soft-deleted post
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->where('user_id', Auth::id())->first();

        if ($post) {
            $post->restore();  // Restore the post

            // Clear the cache after restoring a post
            Cache::forget('user_posts_' . Auth::id());
            Cache::forget('trashed_user_posts_' . Auth::id());

            return redirect()->route('posts.index')->with('success', 'Post restored.');
        }

        return redirect()->route('posts.index')->with('error', 'Post not found or unauthorized.');
    }

    // Permanently delete a soft-deleted post
    public function forceDelete($id)
    {
        $post = Post::withTrashed()->where('id', $id)->where('user_id', Auth::id())->first();

        if ($post) {
            $post->forceDelete();  // Permanently delete the post

            // Clear the cache after force deleting a post
            Cache::forget('user_posts_' . Auth::id());
            Cache::forget('admin_posts');
            Cache::forget('trashed_user_posts_' . Auth::id());

            return redirect()->route('posts.index')->with('success', 'Post permanently deleted.');
        }

        return redirect()->route('posts.index')->with('error', 'Post not found or unauthorized.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ensure that only admins can access this page
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }
    
        // Fetch all users with their post count
        $users = User::withCount('posts')->get();
    
        // Fetch all posts with their comments and the user who commented
        $posts = Post::with(['user', 'comments.user'])->get();  // Eager loading users and comments with each post
    
        // Count the total number of users and posts
        $userCount = $users->count();
        $postCount = $posts->count();
    
        return view('admin.index', compact('users', 'posts', 'userCount', 'postCount'));
    }
    


    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.index')->with('success', 'Post deleted successfully.');
    }
    public function editUser(User $user)
    {
        // Ensure the user is an admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        // Ensure the user is an admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Update the user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.index')->with('success', 'User updated successfully.');
    }
    public function editPost(Post $post)
    {
        // Ensure the user is an admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return view('admin.posts.edit', compact('post'));
    }

    public function updatePost(Request $request, Post $post)
    {
        // Ensure the user is an admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Update the post
        $post->update([
            'title' => $request->title,
        ]);

        return redirect()->route('admin.index')->with('success', 'Post updated successfully.');
    }
}

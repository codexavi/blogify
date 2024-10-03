<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\LogUserActivity;
use App\Http\Middleware\XSSProtection;

// Public routes //ddos prevention // XSS prevention // log user activities
Route::middleware(['guest', LogUserActivity::class, 'throttle:60,1', XSSProtection::class])->group(function () {
    
    Route::get('/', function () {
        return view('welcome');
    });
    //register routes 
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
  
    //login routes
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // Google Callback
    Route::get('auth/google', [SocialLoginController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback']);

    // Facebook Callback
    Route::get('auth/facebook', [SocialLoginController::class, 'redirectToFacebook'])->name('facebook.login');
    Route::get('auth/facebook/callback', [SocialLoginController::class, 'handleFacebookCallback']);

});

//ddos prevention // XSS prevention // log user activities //auth route
Route::middleware(['auth', 'verified', LogUserActivity::class, 'throttle:60,1', XSSProtection::class])->group(function () {
   
    // Protected routes (after login)

    Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   

    // Public routes to view all posts and individual posts

    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');


    // Routes for Regular Users (can manage their own posts)

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); // soft deletes
    Route::get('/posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore'); // Restore post
    Route::get('/posts/{post}/forceDelete', [PostController::class, 'forceDelete'])->name('posts.forceDelete'); // Force delete post

    
    // Only authenticated users can comment

    Route::post('/blog/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    //Admin Section


    // Routes for managing users
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.index');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.destroy');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');

    // Routes for managing posts

    Route::get('/admin/posts/{post}/edit', [AdminController::class, 'editPost'])->name('admin.posts.edit');
    Route::put('/admin/posts/{post}', [AdminController::class, 'updatePost'])->name('admin.posts.update');
    Route::delete('/admin/posts/{post}', [AdminController::class, 'deletePost'])->name('admin.posts.destroy');
});

require __DIR__ . '/auth.php';

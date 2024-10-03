<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes trait

class Post extends Model
{
    use HasFactory, SoftDeletes; // Enable Soft Deletes for Post
    
    protected $fillable = ['title', 'content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class); // A post belongs to a user
    }
    // Define the relationship between Post and Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

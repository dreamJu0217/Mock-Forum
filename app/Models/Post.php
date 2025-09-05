<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id', 'anonymous', 'likes', 'solved', 'reported']; 

    // Define the 'solved' property
    protected $attributes = [
        'solved' => false, // Default value is false
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function markSolved(Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if (auth()->id() !== $post->user_id) {
            // Toggle the solved status of the post
            $post->update(['solved' => !$post->solved]);
        }

        // Redirect back to the post view
        return redirect()->back();
    }

}
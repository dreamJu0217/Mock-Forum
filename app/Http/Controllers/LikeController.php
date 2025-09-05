<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    // In LikeController.php
// public function like(Post $post) {
//     $post->increment('likes');
//     return redirect()->back();
// }
// In LikeController.php


public function like(Post $post) {
    // Check if the user has already liked the post
    $existingLike = Like::where('user_id', auth()->id())
                        ->where('post_id', $post->id)
                        ->first();

    // If the user hasn't liked the post yet, create a new like
    if (!$existingLike) {
        // Increment the post's like count
        $post->increment('likes');

        // Create a new like record in the database
        Like::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);
    }

    return redirect()->back();
}

}

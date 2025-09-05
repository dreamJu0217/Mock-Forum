<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Reply;


class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'body' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        // Create a new comment
        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->post_id = $request->input('post_id'); // Assuming you have a hidden input field for post_id in your form
        $comment->user_id = auth()->id();
        $comment->save();


        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    public function deleteComment(Comment $comment)
{
    // Check if the authenticated user owns the comment
    if (auth()->user()->id === $comment->user_id) {
        // Delete the comment
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
        }
        
        // If the user doesn't own the comment, return with an error message
        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }

    public function storeReply(Request $request)
    {
        
        $validatedData = $request->validate([
            'comment_id' => 'required|exists:comments,id',
            'body' => 'required|string',
        ]);

        // Create a new reply instance
        $reply = new Reply();
        $reply->comment_id = $validatedData['comment_id'];
        $reply->user_id = auth()->user()->id;
        $reply->body = $validatedData['body'];
        $reply->save();

        // Redirect back or return a response
        return redirect()->back()->with('success', 'Reply created successfully!');
    }
    public function deleteReply(Reply $reply)
    {
        // Check if the authenticated user owns the reply
        if (auth()->user()->id === $reply->user_id) {
            // Delete the reply
            $reply->delete();
            return redirect()->back()->with('success', 'Reply deleted successfully.');
        }
        
        // If the user doesn't own the reply, return with an error message
        return redirect()->back()->with('error', 'You are not authorized to delete this reply.');
}

}
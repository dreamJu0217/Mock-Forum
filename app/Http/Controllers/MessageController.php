<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PrivateMessage;

class MessageController extends Controller
{
    // Show the compose message form
    public function compose()
    {
        $users = User::all(); // Get all users to populate the recipient dropdown
        return view('messages.compose', compact('users'));
    }

    
    public function send(Request $request)
    {
        // Validate the request data
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'message' => 'required',
        ]);

        // Create a new message
        $message = new PrivateMessage();
        $message->sender_id = auth()->id();
        $message->recipient_id = $request->recipient_id;
        $message->message = $request->message;
        $message->save();

        return redirect('/home');
    }

    // Show the user's inbox
    public function inbox()
    {
        $messages = PrivateMessage::where('recipient_id', auth()->id())
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('messages.inbox', compact('messages'));
    }
}
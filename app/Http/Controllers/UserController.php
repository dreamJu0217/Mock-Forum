<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    public function block(Request $request, User $user) {
        $request->user()->blocks()->create([
            'blocked_user_id' => $user->id,
        ]);
    
        return back()->with('status', 'User blocked successfully.');
    }
    
    public function unblock(Request $request, User $user) {
        $request->user()->blocks()->where('blocked_user_id', $user->id)->delete();
    
        return back()->with('status', 'User unblocked successfully.');
    }
}

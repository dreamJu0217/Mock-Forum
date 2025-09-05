<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Draft;


class ProfileController extends Controller
{
    // public function show()
    // {
    //     // Retrieve the authenticated user
    //     $user = auth()->user();

    //     // Return the view with the user's profile information
    //     return view('profile.show', compact('user'));
    // }
    public function show()
    {
        // Check if there is an authenticated user
        if (!auth()->check()) {
            // Redirect to the home page
            return  'No account  made yet';
        }

        // Retrieve the authenticated user
        $user = auth()->user();

        // Return the view with the user's profile information
        return view('profile.show', ['user' => $user]);
    }


}

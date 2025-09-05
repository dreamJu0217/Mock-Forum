<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
class AdminController extends Controller
{
    public function showAdminLoginForm()
    {
        return view('admin');
    }

    // Method to process the admin login
    public function adminLogin(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the user using the provided credentials
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'], $request->remember)) {
            // If the login attempt is successful, redirect the user to the admin dashboard or any other desired location
            return redirect()->intended('/admin/dashboard');
        } else {
            // If the login attempt fails, redirect back with an error message
            return view('admin_error');
        }
    }
    public function blabla()
    {
        $posts = Post::all();
        $users=User::all();
        
        // Pass the retrieved posts to the view
        return view('admin', ['posts' => $posts, 'users' => $users]);
    }
    public function deletePost($postId) {
    //     if (auth()->user()->id === $post['user_id']) {
    //         $post->delete();
    //     }
    //     return redirect('/');
        // Retrieve the post by its ID
        $post = Post::find($postId);

        // Check if the post exists
        if ($post) {
            // Delete the post
            $post->delete();

            // Redirect back with a success message or perform any other action
            return redirect('/');
        } else {
            // If the post does not exist, redirect back with an error message
            return redirect()->back()->with('error', 'Post not found.');
        }
    }
    public function deleteUser($userId) {
        // Retrieve the user by its ID
        $user = User::find($userId);
    
        // Check if the user exists
        if ($user) {
            // Delete the user
            $user->delete();
    
            // Redirect back with a success message or perform any other action
            return redirect()->back()->with('success', 'User account deleted successfully.');
        } else {
            // If the user does not exist, redirect back with an error message
            return redirect()->back()->with('error', 'User not found.');
        }
    }
    public function reportPost($postId)
    {
        // Retrieve the post by its ID
        $post = Post::findOrFail($postId);
    
        // Pass the post data to the admin dashboard view
        return view('admin')->with('post', $post);
    }
    
    


}
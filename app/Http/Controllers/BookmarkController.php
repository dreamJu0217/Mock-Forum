<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Post;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $user = auth()->user();

        if (!$user->bookmarks()->where('post_id', $post->id)->exists()) {
            $user->bookmarks()->create(['post_id' => $post->id]);
            return redirect()->route('show', $post->id)->with('success', 'Post bookmarked successfully.');
        }

        return redirect()->back()->with('error', 'Post is already bookmarked.');
    }
    public function index()
        {
            $user = auth()->user(); // Get the authenticated user
    $bookmarks = $user->bookmarks()->with('post')->get(); // Assuming 'post' is the relationship name

    return view('show', compact('user', 'bookmarks')); // Pass both $user and $bookmarks to the profile.show view
}

public function destroy(Bookmark $bookmark)
{
    $bookmark->delete();
    return redirect()->back()->with('success', 'Bookmark removed successfully.');
}

}


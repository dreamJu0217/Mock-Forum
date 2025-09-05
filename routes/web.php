<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    $posts = Post::all();
    return view('home', ['posts' => $posts]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Blog post related routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

// Search post
Route::get('/search', [PostController::class, 'search'])->name('search');

// Route for displaying the profile
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

// Route for toggling follow/unfollow
Route::post('/follow/{user}', [FollowController::class, 'toggleFollow'])->name('follow.toggle');

// Route for displaying the following page
Route::get('/user/following', [FollowController::class, 'following'])->name('user.following');

// Route for displaying the followers page
Route::get('/user/followers', [FollowController::class, 'followers'])->name('user.followers');
Route::delete('/delete-acc/{user}', [PostController::class, 'deleteacc']);
// In routes/web.php
Route::post('/like/{post}', [LikeController::class,'like'])->name('like');
Route::delete('/confirm-delete-account/{user}', [PostController::class, 'confirmDel']);
Route::get('send',[PostController::class,'sendnotifications']);

// routes/web.php
// Route::get('/admin/dashboard',[AdminController::class,'adminlogin']);
Route::get('/compose', [MessageController::class, 'compose'])->name('compose');
Route::post('/send', [MessageController::class, 'send'])->name('messages.send');
Route::get('/inbox', [MessageController::class, 'inbox'])->name('inbox');
//Route for comment
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
Route::delete('/delete-comment/{comment}', [CommentController::class, 'deleteComment'])->name('comment.delete');

//Route for reply
Route::post('/comments/reply', [CommentController::class, 'storeReply'])->name('comments.reply');
Route::delete('/reply/{reply}', [CommentController::class, 'deleteReply'])->name('reply.delete');

//Route for bookmark
Route::post('/posts/{post}/bookmark', [BookmarkController::class, 'store'])->name('posts.bookmark.store');
Route::delete('/bookmarks/{bookmark}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
Route::get('/profile', [BookmarkController::class, 'index'])->name('show');


Route::patch('/posts/{post}/mark-solved', [PostController::class, 'markSolved'])->name('posts.markSolved');

Route::post('/user/{user}/block', [UserController::class, 'block'])->name('user.block');
Route::post('/user/{user}/unblock', [UserController::class, 'unblock'])->name('user.unblock');

Route::post('/post/{post}/report', [PostController::class,'report'])->name('post.report');

Route::delete('/admin/users/{userId}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

Route::delete('/admin/posts/{postId}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');

Route::get('/admin/dashboard', [AdminController::class, 'blabla'])->name('admin.login.submit');

Route::post('/admin/dashboard', [AdminController::class, 'adminLogin'])->name('admin.login.submit');

Route::get('/admin', [AdminController::class, 'showAdminLoginForm'])->name('admin.login');
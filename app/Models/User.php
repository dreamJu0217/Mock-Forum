<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    // public function usersCoolPosts() {
        // return $this->hasMany(Post::class, 'user_id');
    // }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    public function following() {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'followed_id');
    }
    
    public function followers() {
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'follower_id');
    }
    
    public function isFollowing(User $user) {
        return $this->following()->where('followed_id', $user->id)->exists();
    }
    
    public function follow(User $user) {
        $this->following()->attach($user->id);
    }
    
    public function unfollow(User $user) {
        $this->following()->detach($user->id);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
    
    public function blocks() {
        return $this->hasMany(UserBlock::class, 'user_id');
    }
    
    public function isBlocking(User $user) {
        return $this->blocks()->where('blocked_user_id', $user->id)->exists();
    }
}

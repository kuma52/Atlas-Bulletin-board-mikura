<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'admin_role',
    ];

    public function likePostId()
    {
        return Like::where('like_user_id', Auth::id());
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function postComments()
    {
        return $this->hasMany(PostComment::class);
    }
    public function postFavorites()
    {
        return $this->hasMany(PostFavorite::class);
    }

    public function postCommentFavorites()
    {
        return $this->hasMany(PostCommentFavorite::class);
    }
}

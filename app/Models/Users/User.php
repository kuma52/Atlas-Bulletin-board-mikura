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

    public function posts()
    {
        return $this->hasMany('App\Models\Posts\Post');
    }

    public function postComments()
    {
        return $this->hasMany('App\Models\Posts\PostComment');
    }
    public function postFavorites()
    {
        return $this->hasMany('App\Models\Posts\PostFavorite');
    }

    public function postCommentFavorites()
    {
        return $this->hasMany('App\Models\Posts\PostCommentFavorite');
    }
}

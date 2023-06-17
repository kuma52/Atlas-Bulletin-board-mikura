<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Posts\PostFavorite;
use Illuminate\Support\facades\Auth;

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
        return PostFavorite::where('like_user_id', Auth::id());
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
        return $this->hasMany('App\Models\Posts\PostFavorite', 'user_id');
    }

    public function postCommentFavorites()
    {
        return $this->hasMany('App\Models\Posts\PostCommentFavorite');
    }

    // 自分がいいねしているかどうか
    public function is_Favorite($post_id)
    {
        return PostFavorite::where('user_id', Auth::id())->where('post_id', $post_id)->first(['post_favorites.id']);
    }
}

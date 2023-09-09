<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Posts\PostFavorite;
use App\Models\Posts\PostCommentFavorite;
use Illuminate\Support\facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

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

    public function action_logs()
    {
        return $this->hasMany('App\Models\ActionLogs\ActionLog');
    }

    // 自分がpostにいいねしているかどうか
    public function is_Favorite($post_id)
    {
        return PostFavorite::where('user_id', Auth::id())->where('post_id', $post_id)->first(['post_favorites.id']);
    }


    //いいねしている投稿のidを引き出す
    public function favoritePostId()
    {
        return PostFavorite::where('user_id', Auth::id());
    }

    // 自分がcommentにいいねしているかどうか
    public function is_commentFavorite($post_comment_id)
    {
        return PostCommentFavorite::where('user_id', Auth::id())->where('post_comment_id', $post_comment_id)->first(['post_comment_favorites.id']);
    }
}

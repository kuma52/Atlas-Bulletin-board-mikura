<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Users\User;

class PostComment extends Model
{
    protected $table = 'post_comments';
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'post_id',
        'delete_user_id',
        'update_user_id',
        'comment',
        'event_at',
    ];

    public function postCommenteFavorites()
    {
        return $this->hasMany('App\Models\Posts\PostCommentFavorite');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Posts\Post');
    }

    public function commentUser($user_id)
    {
        return User::where('id', $user_id)->first();
    }
}

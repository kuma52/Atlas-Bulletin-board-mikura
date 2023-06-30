<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCommentFavorite extends Model
{
    protected $table = 'post_comment_favorites';
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'post_comment_id',
    ];

    public function users()
    {
        return $this->belongsTo('App\Http\Models\Users\User');
    }

    public function posts()
    {
        return $this->belongsTo('App\Http\Models\Posts\Post');
    }

    public function postComments()
    {
        return $this->belongsTo('App\Http\Models\Posts\PostComment');
    }

    //commentへのいいね数
    public function commentFavoriteCounts($post_comment_id)
    {
        return $this->where('post_comment_id', $post_comment_id)->get()->count();
    }
}

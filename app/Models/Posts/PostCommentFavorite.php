<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostCommentFavorite extends Model
{
    protected $table = 'post_comment_favorites';

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
}

<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $table = 'posts';

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'post_sub_category_id',
        'delete_user_id',
        'update_user_id',
        'title',
        'post',
        'event_at',
    ];

    //postは一つのuserに属する
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    //投稿のsubカテゴリ
    public function postSubCategory()
    {
        return $this->belongsTo('App\Models\Posts\PostSubCategory', 'post_sub_category_id', 'id');
    }

    public function postComments()
    {
        return $this->hasMany('App\Models\Posts\PostComment');
    }

    public function postFavorites()
    {
        return $this->hasMany('App\Models\Posts\PostFavorite');
    }

    //postCommentsテーブルからpost_idのレコードだけ引っ張る＝コメント数
    public function commentCounts($post_id)
    {
        return Post::with('postComments')->find($post_id)->postComments();
    }
}

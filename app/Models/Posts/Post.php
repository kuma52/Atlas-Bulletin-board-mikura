<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

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
        return $this->hasOne('App\Models\Posts\PostSubCategory', 'id', 'post_sub_category_id');
    }

    public function postComments()
    {
        return $this->hasMany('App\Models\Posts\PostComment');
    }

    public function postFavorites()
    {
        return $this->hasMany('App\Models\Posts\PostFavorite');
    }
}

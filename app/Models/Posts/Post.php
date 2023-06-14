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
        return $this->belongsTo('App\Models\Users\Users\User');
    }

    //投稿のsubカテゴリ
    public function postSubCategories()
    {
        return $this->hasOne(PostSubCategory::class);
    }

    public function postComments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function postFavorites()
    {
        return $this->hasMany(PostFavorite::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}

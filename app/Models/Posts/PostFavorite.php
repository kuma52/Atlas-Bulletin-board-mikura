<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostFavorite extends Model
{
    protected $table = 'post_favorites';
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    public function favoriteCounts($post_id)
    {
        return $this->where('post_id', $post_id)->get()->count();
    }

    public function users()
    {
        return $this->belongsTo('App\Models\Users\User');
    }
    public function posts()
    {
        return $this->belongsTo('App\Models\Posts\Post');
    }
}

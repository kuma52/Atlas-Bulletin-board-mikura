<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostSubCategory extends Model
{
    protected $table = 'post_sub_categories';

    protected $fillable = [
        'post_main_category_id',
        'sub_category',
    ];

    public function sPostMainCategories()
    {
        return $this->belongsTo(PostMainCategory::class);
    }

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}

<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostMainCategory extends Model
{
    protected $table = 'post_main_categories';
    use SoftDeletes;

    protected $fillable = [
        'main_category',
    ];

    public function sPostSubCategories()
    {
        return $this->hasMany('App\Models\Posts\PostSubCategory');
    }
}

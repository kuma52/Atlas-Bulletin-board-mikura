<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;

class PostsController extends Controller
{
    //
    public function show()
    {
        $sub_category = PostSubCategory::all();
        $main_categories = PostMainCategory::with('sPostSubCategories')->get();
        // dd($main_categories);
        return view('logined.categories_edit', compact('sub_category', 'main_categories'));
    }
}

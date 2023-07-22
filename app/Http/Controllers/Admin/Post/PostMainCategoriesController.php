<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostMainCategoryRequest;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;

class PostMainCategoriesController extends Controller
{
    //PostMainCategory
    public function create(Request $request)
    {
        PostMainCategory::create([
            'main_category' => $request->new_main_category
        ]);
        $sub_category = PostSubCategory::all();
        $main_categories = PostMainCategory::with('sPostSubCategories')->get();
        // return redirect(route('show.categories'));
        return view('logined.categories_edit', compact('sub_category', 'main_categories'));
    }
}

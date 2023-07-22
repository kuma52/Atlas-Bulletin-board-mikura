<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostSubCategory;
use App\Http\Requests\PostSubCategoryRequest;
use App\Models\Posts\PostMainCategory;


class PostSubCategoriesController extends Controller
{
    //
    public function create(Request $request)
    {
        PostSubCategory::create([
            'post_main_category_id' => $request->main_category,
            'sub_category' => $request->new_sub_category
        ]);
        $sub_category = PostSubCategory::all();
        $main_categories = PostMainCategory::with('sPostSubCategories')->get();
        return view('logined.categories_edit', compact('sub_category', 'main_categories'));
    }

    public function delete($sub_category_id)
    {
        // Modelにsoftdeleteをuseしてるので、物理削除はされない。論理削除がされる。
        // $sub_category_id = $request->sub_category_id;
        // dd($sub_category_id);
        PostSubCategory::findOrFail($sub_category_id)->delete();
        $sub_category = PostSubCategory::all();
        $main_categories = PostMainCategory::with('sPostSubCategories')->get();
        return view('logined.categories_edit', compact('sub_category', 'main_categories'));
    }
}

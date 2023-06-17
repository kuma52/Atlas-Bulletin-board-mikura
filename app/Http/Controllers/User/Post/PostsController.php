<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostFavorite;
use Illuminate\Support\facades\Auth;
use App\Http\Requests\PostFormRequest;
use App\Models\Users\User;


class PostsController extends Controller
{
    //auth認証を適用
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(Request $request)
    {
        $posts = Post::with('user', 'postComments', 'postFavorites', 'postSubCategory')
            ->latest() //最新のものを
            ->paginate(10); //10こだけ
        $sub_category = PostSubCategory::all();
        // dd($sub_category);
        $post_comment = new Post;
        $favorite = new PostFavorite;
        return view('logined.dashboard', compact('posts', 'sub_category', 'post_comment', 'favorite'));
    }

    public function open()
    {
        $main_categories = PostMainCategory::with('sPostSubCategories')->get();
        $sub_categories = PostSubCategory::get();
        // dd($main_categories);
        return view(
            'logined.post_create',
            compact('main_categories', 'sub_categories')
        );
    }

    //投稿をcreate
    public function create(PostFormRequest $request)
    {
        //postテーブルに値を送信
        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'post' => $request->post,
            'post_sub_category_id' => $request->sub_category_id,
            'event_at' => $request->event_at
        ]);

        return redirect()->route('home');
    }
}

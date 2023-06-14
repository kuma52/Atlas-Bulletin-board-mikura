<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use App\Http\Requests\PostFormRequest;
use Illuminate\Support\facades\Auth;

class PostsController extends Controller
{
    //auth認証を適用
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(Request $request)
    {
        $posts = Post::latest()->get();
        return view('logined.dashboard', compact('posts'));
    }

    public function open()
    {
        $main_categories = PostMainCategory::with('subCategories')->get();
        $sub_categories = PostSubCategory::get();
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
            'post_sub_category_id' => $request->sub_category_id
        ]);

        return redirect()->route('home');
    }
}

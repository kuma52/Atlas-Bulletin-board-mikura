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

    public function show(Request $request)
    {
        $sub_category = PostSubCategory::all();
        $post_comment = new Post;
        $favorite = new PostFavorite;
        $main_category = PostMainCategory::with('sPostSubCategories')->get();
        $posts = Post::with('user', 'postComments', 'postFavorites', 'postSubCategory');

        if (!empty($request->keyword)) { //もしキーワードに入力があれば
            $posts = Post::with('user', 'postComments')
                ->where('title', 'like', '%' . $request->keyword . '%')
                ->orWhere('post', 'like', '%' . $request->keyword . '%')
                ->latest()->paginate(10);
        } else if ($request->category_word) { //もしカテゴリーが押されたら
            //subcategoriesテーブル（←中間テーブル）から、sub_categoryカラムが●●の時のpost_idカラムの値を取り出してきたい
            // dd($request);
            $sub_category = $request->category_word;
            $posts = Post::with('user', 'postComments')
                ->whereHas('postSubCategory', function ($query) use ($sub_category) {
                    $query->where('sub_category', $sub_category);
                })->latest()->paginate(10);
        } else if ($request->favorite_posts) { //もしいいねした投稿がおされたら
            $favorites = Auth::user()->favoritePostId()->get('post_id');
            $posts = Post::with('user', 'postComments')
                ->whereIn('id', $favorites)->latest()->paginate(10);
        } else if ($request->my_posts) { //もし自分の投稿が押されたら
            $posts = Post::with('user', 'postComments')
                ->where('user_id', Auth::id())->latest()->paginate(10);
        } else { //もしキーワードが入力ナシなら
            $posts = $posts->latest()->paginate(10);
        }

        return view('logined.dashboard', compact('posts', 'sub_category', 'post_comment', 'favorite', 'main_category'));
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

    //投稿詳細画面
    public function postDetail($post_id)
    {
        $post = Post::with('user')->findOrFail($post_id);
        $post_comment = PostComment::with('user_id', 'post_id')->findOrFail($post_id);

        return view('logined.post_detail', compact('post', 'post_comment'));
    }
}

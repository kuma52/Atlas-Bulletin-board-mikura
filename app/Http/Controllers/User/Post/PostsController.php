<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\PostCommentFavorite;
use App\Models\Posts\PostFavorite;
use App\Models\ActionLogs\ActionLog;
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
        $view = new ActionLog;
        // $posts = Post::with('user', 'postComments', 'postFavorites', 'postSubCategory')->get();//get付けたら一回エラーを抜けた　でもlatest解決しようとしたらまた同じエラー
        // $posts = Post::all();

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
            // $favorites = Post::with('favoritePostId')->get('post_id');
            $posts = Post::with('user', 'postComments')
                ->whereIn('id', $favorites)->latest()->paginate(10);
        } else if ($request->my_posts) { //もし自分の投稿が押されたら
            $posts = Post::with('user', 'postComments')
                ->where('user_id', Auth::id())->latest()->paginate(10);
        } else { //検索何もしてなかったとき
            $posts = Post::with('user', 'postComments', 'postFavorites', 'postSubCategory')->latest()->paginate(10);
            // $posts = Post::with('user', 'postComments', 'postFavorites', 'postSubCategory')->get()->orderBy('created_at', 'desc')->paginate(10);
        }

        $posts->load('postSubCategory'); // 各ページ内の投稿の postSubCategory リレーションを読み込む
        // dd($favorite);
        return view('logined.dashboard', compact('posts', 'sub_category', 'post_comment', 'favorite', 'main_category'));
    }

    //投稿作成画面を表示
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
        // dd($request);
        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'post' => $request->post,
            'post_sub_category_id' => $request->sub_category_id,
            'event_at' => $request->event_at
        ]);

        return redirect()->route('post.show');
    }

    //投稿詳細画面
    public function postDetail($post_id)
    {
        // $post = Post::with('user', 'postComments', 'postFavorites', 'action_logs')->where('id', $post_id)->get();
        $post = Post::with('user', 'postComments', 'postFavorites', 'action_logs')->where('id', $post_id)->first();
        // $post = Post::with('user', 'postcomments', 'postFavorites')->findOrFail($post_id);
        // dd($post);
        $favorite = new PostFavorite;
        $c_favorite = new PostCommentFavorite;
        $view = new ActionLog;
        // actionlogをテーブルに登録
        ActionLog::create([
            'user_id' => Auth::id(),
            'post_id' => $post_id,
            'event_at' => now()->format('Y-m-d')
        ]);
        // 閲覧数を取得
        $actionlog = new ActionLog();
        $post_id = (int)$post_id;
        $viewCount = $actionlog->viewCounts($post_id);
        // dd(gettype($post_id));
        // dd($post_id);
        return view('logined.post_detail', compact('post', 'favorite', 'c_favorite', 'post_id', 'view'));
    }

    //投稿編集画面
    public function showEdit($post_id)
    {
        $main_categories = PostMainCategory::with('sPostSubCategories')->get();
        $sub_categories = PostSubCategory::get();
        $post = Post::where('id', $post_id)->get();
        return view('logined.post_edit', compact('post', 'main_categories', 'sub_categories'));
    }

    //投稿編集機能
    public function postEdit(PostFormRequest $request)
    {
        Post::where('id', $request->post_id)->update([
            'title' => $request->title,
            'post' => $request->post,
            'post_sub_category_id' => $request->sub_category_id,
            'update_user_id' => Auth::id()
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($post_id)
    {
        //softDeleteしながらdeleteUserIdは変更できないぽ→変更してからDelete
        Post::where('id', $post_id)->update([
            'delete_user_id' => Auth::id()
        ]);
        // postModelにsoftdeleteをuseしてるので、物理削除はされない。論理削除がされる。
        Post::findOrFail($post_id)->delete();
        return redirect()->route('post.show');
    }
}

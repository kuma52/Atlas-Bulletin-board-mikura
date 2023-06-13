<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
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
        return view('logined.post_create');
    }

    public function create(PostFormRequest $request)
    {
        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    //
    public function commentCreate()
    {
        return view('post_detail');
    }

    public function showEdit(Request $request)
    {
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }
}

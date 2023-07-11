<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostCommentFavorite;
use Illuminate\Support\facades\Auth;

class PostCommentFavoritesController extends Controller
{
    //
    public function commentFavorite(Request $request)
    {
        $user_id = Auth::id();
        $post_comment_id = $request->post_comment_id;

        $c_favorite = new PostCommentFavorite;

        $c_favorite->user_id = $user_id;
        $c_favorite->post_comment_id = $post_comment_id;
        $c_favorite->save();

        return response()->json();
    }

    public function commentunFavorite(Request $request)
    {
        $user_id = Auth::id();
        $post_comment_id = $request->post_comment_id;

        $c_favorite = new PostCommentFavorite;

        $c_favorite->where('user_id', $user_id)
            ->where('post_comment_id', $post_comment_id)
            ->delete();

        return response()->json();
    }
}

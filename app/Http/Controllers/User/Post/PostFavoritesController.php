<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Posts\PostFavorite;

class PostFavoritesController extends Controller
{

    public function postFavorite(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new PostFavorite;

        $like->favorite_user_id = $user_id;
        $like->favorite_post_id = $post_id;
        $like->save();

        return response()->json();
    }

    public function postUnFavorite(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new PostFavorite;

        $like->where('favorite_user_id', $user_id)
            ->where('favorite_post_id', $post_id)
            ->delete();

        return response()->json();
    }
}

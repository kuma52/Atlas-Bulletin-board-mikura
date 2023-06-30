<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostFavorite;
use Auth;

class PostFavoritesController extends Controller
{

    public function postFavorite(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $favorite = new PostFavorite;

        $favorite->user_id = $user_id;
        $favorite->post_id = $post_id;
        $favorite->save();

        return response()->json();
    }

    public function postUnFavorite(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $favorite = new PostFavorite;

        $favorite->where('user_id', $user_id)
            ->where('post_id', $post_id)
            ->delete();

        return response()->json();
    }


    // public function postFavorite(Request $request)
    // {

    // }
}

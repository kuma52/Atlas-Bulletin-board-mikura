<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostComment;
use Illuminate\Support\facades\Auth;

class PostCommentsController extends Controller
{
    //comment作成
    public function create(Request $request)
    {
        // dd($request);
        PostComment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'comment' => $request->comment,
            'event_at' => $request->event_at
        ]);

        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    //comment編集画面
    public function showEdit($comment_id)
    {
        // dd($comment_id);
        $comment = PostComment::where('id', $comment_id)->get();
        return view('logined.comment_edit', ['id' => $comment_id], compact('comment'));
    }

    //comment編集機能
    public function edit(Request $request)
    {
        $comment_id = $request->comment_id;
        // dd($request);
        PostComment::where('id', $comment_id)->update([
            'comment' => $request->newComment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    //comment削除機能
    public function delete($comment_id)
    {
        // Modelにsoftdeleteをuseしてるので、物理削除はされない。論理削除がされる。
        PostComment::findOrFail($comment_id)->delete();
        return redirect()->route('post.show');
    }
    //次に始めるときは$comment_idがちゃんとコントローラに渡ってるかどうか確認するところから。
}

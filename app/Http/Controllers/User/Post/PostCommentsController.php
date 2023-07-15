<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostComment;
use Illuminate\Support\facades\Auth;
use App\Http\Requests\PostCommentRequest;

class PostCommentsController extends Controller
{
    //comment作成
    public function create(PostCommentRequest $request)
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
    public function edit(PostCommentRequest $request)
    {
        $comment_id = $request->comment_id;
        // dd($request);
        PostComment::where('id', $comment_id)->update([
            'comment' => $request->newComment,
            'update_user_id' => Auth::id()
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    //comment削除機能
    public function delete($comment_id)
    {
        //softDeleteしながらdeleteUserIdは変更できないぽ→変更してからDelete
        PostComment::where('id', $comment_id)->update([
            'delete_user_id' => Auth::id()
        ]);
        // Modelにsoftdeleteをuseしてるので、物理削除はされない。論理削除がされる。
        PostComment::findOrFail($comment_id)->delete();
        return redirect()->route('post.show');
    }
}

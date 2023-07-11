@extends('logined.layouts.layout')

@section('content')
<div class="inner">
    <h2>コメント編集画面</h2>
    @foreach($comment as $comment)
    <div class="contents_wrapper">
        <form action="{{ route( 'comment.edit', ['id' => $comment->id] ) }}" method="post">
            @csrf
            <div class="contents">
                <label for="comment">コメント</label>
                <textarea type="text" name="newComment" value="{{$comment -> comment}}">{{$comment -> comment}}</textarea>
                @if($errors->first('comment'))
                <span class="error_message">{{ $errors->first('post') }}</span>
                @endif
            </div>
            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
            <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
            <!-- <input type="hidden" name="event_at" value="{{ now()->format('Y-m-d') }}"> -->
            <div class="contents">
                <input type="submit" class="btn" value="更新">
                <input type="submit" class="btn" value="削除" form="delete">
            </div>
        </form>
        <form action="{{route('comment.delete',['id' => $comment->id] )}}" method="post" id="delete">@csrf</form>
    </div>
    @endforeach
</div>
@endsection

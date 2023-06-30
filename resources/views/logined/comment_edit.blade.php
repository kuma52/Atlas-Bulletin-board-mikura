@extends('logined.layouts.layout')

@section('content')
<div class="inner">
    <h2>投稿編集画面</h2>

    <div class="contents_wrapper">
        <form action="" method="post">
            @csrf
            <div class="contents">
                <label for="comment">コメント</label>
                <input type="text" name="comment" value=""></input>
                @if($errors->first('comment'))
                <span class="error_message">{{ $errors->first('post') }}</span>
                @endif
            </div>
            <input type="hidden" name="event_at" value="{{ now()->format('Y-m-d') }}">
            <div class="contents">
                <input type="submit" class="btn" value="更新">
                <input type="submit" class="btn" value="削除">
            </div>
        </form>
    </div>
</div>
@endsection

@extends('logined.layouts.layout')

@section('content')
<div class="inner">
    <h2>掲示板詳細画面</h2>
    <!-- foreach($post as $posts) -->
    <div class="d-flex">
        <p class="bold">{{ $post->user->username }}さん</p>
        <span class="small">{{ $post->event_at}}</span>
        <span class="small pl-1">{{ $view->viewCounts($post_id) }} View</span>
        @if($post->user_id == Auth::user()->id)
        <div>
            <a href="{{ route('show.edit', ['id' => $post->id] ) }}" class="btn_design" title="{{ $post->post_title }}" post="{{ $post->post }}" id="{{ $post->id }}">編集</a>
        </div>
        @endif
    </div>
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->post }}</p>
    <div class="d-flex">
        <span class="icon">{{ $post->postSubCategory->sub_category }}</span>
        <span class="small">コメント数{{ $post->commentCounts($post->id)->count() }}</span>
        @if(Auth::user()->is_Favorite($post->id))
        <span>
            <i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i>
            <span class="favorite_counts{{ $post->id }}">{{ $favorite->favoriteCounts($post->id) }}</span>
        </span>
        @else
        <span>
            <i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i>
            <span class="favorite_counts{{ $post->id }}">{{ $favorite->favoriteCounts($post->id) }}</span>
        </span>
        @endif
        <!-- endforeach -->
    </div>

    <div class="comment_area">
        @foreach($post->postComments as $post_comment)
        <div class="d-flex">
            <p class="bold">{{ $post_comment->commentUser($post_comment->user_id)->username }}さん</p>
            <span class="small">{{ $post_comment->event_at}}</span>
        </div>
        <p>{{ $post_comment->comment }}</p>
        <div>
            @if($post_comment->user_id == Auth::user()->id)
            <a href="{{ route('show.comment.edit', ['id' => $post_comment->id] ) }}" comment="{{ $post_comment->comment }}" id="{{ $post_comment->id }}">編集</a>
            @endif
            @if(Auth::user()->is_commentFavorite($post_comment->id))
            <span>
                <i class="fas fa-heart c_un_like_btn" post_comment_id="{{ $post_comment->id }}"></i>
                <span class="comment_favorite_counts{{ $post_comment->id }}">{{ $c_favorite->commentFavoriteCounts($post_comment->id) }}</span>
            </span>
            @else
            <span>
                <i class="fas fa-heart c_like_btn" post_comment_id="{{ $post_comment->id }}"></i>
                <span class="comment_favorite_counts{{ $post_comment->id }}">{{ $c_favorite->commentFavoriteCounts($post_comment->id) }}</span>
            </span>
            @endif
        </div>
        @endforeach
        <div>
            <textarea name="comment" class="" form="commentCreate" placeholder="コチラからコメントできます" value="{{ old('comment') }}"></textarea><br>
            <input type="submit" class="btn_design" value="コメント" form="commentCreate">
            <input type="hidden" name="post_id" value="{{ $post_id }}" form="commentCreate">
            <input type="hidden" name="event_at" value="{{ now()->format('Y-m-d') }}" form="commentCreate">
            <form action="{{route('comment.create',['id' => $post->id])}}" method='post' id="commentCreate">@csrf</form>
        </div>

    </div>
</div>


@endsection

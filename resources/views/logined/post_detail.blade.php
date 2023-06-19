@extends('logined.layouts.layout')

@section('content')
<div class="inner">
    <h2>掲示板詳細画面</h2>
    <div class="d-flex">
        <p class="bold">{{ $post->user->username }}さん</p>
        <span class="small">{{ $post->event_at}}</span>
        <span class="small">View</span>
    </div>
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->post}}</p>
    <div class="d-flex">
        <span class="icon">{{ $post->postSubCategory->sub_category }}</span>
        <span class="small">コメント数{{ $post_comment->commentCounts($post->id)->count() }}</span>
        @if(Auth::user()->is_Favorite($post->id))
        <span>
            <i class="fas fa-heart un_like_btn" post_id=""></i>
            <span class="like_counts{{ $post->id }}">{{ $favorite->likeCounts($post->id) }}</span>
        </span>
        @else
        <span>
            <i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i>
            <span class="like_counts{{ $post->id }}">{{ $favorite->likeCounts($post->id) }}</span>
        </span>
        @endif
    </div>

    <!-- <div class="comment_area">
        foreach($post_comment as $post_comment)
        <div class="d-flex">
            <p class="bold">{{ $post_comment->user_id->username }}さん</p>
            <span class="small">{{ $post->event_at}}</span>
        </div>
        <p>コメント</p>
        <div>
            <a href="">編集</a>
            @if(Auth::user()->is_commentFavorite($post->id))
            <span>
                <i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i>
                <span class="comment_like_counts{{ $post->id }}">{{ $favorite->likeCounts($post->id) }}</span>
            </span>
            @else
            <span>
                <i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i>
                <span class="comment_like_counts{{ $post->id }}">{{ $favorite->likeCounts($post->id) }}</span>
            </span>
            @endif
        </div>
        endforeach
    </div>
</div> -->


    @endsection

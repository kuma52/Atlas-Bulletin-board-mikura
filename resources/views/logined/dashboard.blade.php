@extends('logined.layouts.layout')

@section('content')
<div class="inner">
    <h2>掲示板投稿一覧</h2>
    <div class="d-flex">
        <div class="box_wrapper mr-2">
            @foreach($posts as $post)
            <div class="box p-2 mb-2">
                <div class="d-flex mb-2">
                    <span class="small mr-3">{{ $post->user->username }}<span class="small">さん</span></span>
                    <span class="small mr-3">{{ $post->event_at}}</span>
                    <span class="small">View</span>
                </div>
                <a href="{{ route('post.detail', ['id' => $post->id] ) }}" class="p-2">{{ $post->title }}</a>
                <div class="d-flex mt-2">
                    <!-- @if ($post->postSubCategory) -->
                    <span class="icon smaller p-1 mr-3">{{ $post->postSubCategory->sub_category }}</span>
                    <!-- @endif -->
                    <span class="small mr-2 pt-1">コメント数 {{ $post_comment->commentCounts($post->id)->count() }}</span>
                    @if(Auth::user()->is_Favorite($post->id))
                    <span class="mr-2 pt-1">
                        <i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i>
                        <span class="favorite_counts{{ $post->id }}">{{ $favorite->favoriteCounts($post->id) }}</span>
                    </span>
                    @else
                    <span class="mr-2 pt-1">
                        <i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i>
                        <span class="favorite_counts{{ $post->id }}">{{ $favorite->favoriteCounts($post->id) }}</span>
                    </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div class="box_wrapper">
            <div calss="add">
                @if(Auth::user()->admin_role == 1)
                <a href="{{ route('show.categories') }}" class="">カテゴリーを追加</a>
                @endif
                <a href="/post_create" class="blue">投稿</a>
            </div>
            <div class="search_board">
                <form action="{{ route('post.show') }}" class="d-block" method="get">
                    <input type="text" name="keyword" value="{{ old('keyword') }}" placeholder="キーワード" class="keyword_box">
                    <button type="submit" class="keyword_btn letter_space">検索</button>
                    <input type="submit" name="favorite_posts" class="btn_design mt-2 mr-2" value="いいねした投稿">
                    <input type="submit" name="my_posts" class="btn_design mt-2" value="自分の投稿">
                    <p class="mb-1 mt-2">カテゴリー</p><span class="border_line"></span>
                    @foreach($main_category as $main_categories)
                    <div class="mb-2">
                        <p class="mb-0">{{ $main_categories->main_category }}</p>
                        @foreach($main_categories->sPostSubCategories as $sub_category)
                        <input type="submit" name="category_word" class="btn_design mb-1 ml-2" data-category_id="{{ $sub_category->id }}" value="{{ $sub_category->sub_category }}">
                        @endforeach
                    </div>
                    @endforeach
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

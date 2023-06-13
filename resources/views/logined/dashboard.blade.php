@extends('logined.layouts.layout')

@section('content')
<div class="inner">
    <h2>掲示板投稿一覧</h2>
    <div class="d-flex">
        <div class="box_wrapper">
            foreach($posts as $post)
            <div class="box">
                <div class="d-flex">
                    <p class="bold">さん</p>
                    <span class="small">2021年7月1日</span>
                    <span class="small">View</span>
                </div>
                <a href="">title</a>
                <div class="d-flex">
                    foreach($post->subCategories as $sub_category)
                    <span></span>
                    endforeach
                    <span class="small">コメント数</span>
                    if(Auth::user()->is_Like($post->id))
                    <span>
                        <i class="fas fa-heart un_like_btn" post_id=""></i>
                        <span class=""></span>
                    </span>
                    else
                    <span>
                        <i class="fas fa-heart like_btn" post_id=""></i>
                        <span class=""></span>
                    </span>
                    endif
                </div>
            </div>
            endforeach
        </div>
        <div class="box_wrapper">
            @if(Auth::user()->admin_role == 1)
            <a href="/categories_edit" class="btn">カテゴリーを追加</a>
            @endif
            <a href="/post_create">投稿</a>
            <div>
                <form action="{{ route('home') }}" class="d-block" method="get">
                    <input type="text" name="keyword" value="{{ old('keyword') }}" placeholder="">
                    <button type="submit">検索</button>
                    <input type="submit" name="like_posts" class="btn" value="いいねした投稿">
                    <input type="submit" name="my_posts" class="btn" value="自分の投稿">
                </form>
            </div>

        </div>
    </div>
</div>


@endsection

@extends('logined.layouts.layout')

@section('content')
<div class="inner">
    <h2>投稿編集画面</h2>
    @foreach($post as $post)
    <div class="post_contents_wrapper">
        <form action="{{ route( 'post.edit', ['id' => $post->id] ) }}" method="post">
            @csrf
            <div class="post_contents">
                <label for="sub_category_id">サブカテゴリ―</label><br>
                <select class="" name="sub_category_id">
                    <option value="none">---</option>
                    @foreach($main_categories as $main_category)
                    <optgroup label="{{ $main_category->main_category }}">
                        @foreach($main_category->sPostSubCategories as $sub_category)
                        <option value="{{ $sub_category->id }}" @if($post->post_sub_category_id == $sub_category->id) selected @endif>
                            {{ $sub_category->sub_category }}
                        </option>
                        @endforeach
                    </optgroup>
                    @endforeach
                </select>
                @if($errors->first('sub_category_id'))
                <span class="error_message">{{ $errors->first('sub_category_id') }}</span>
                @endif
            </div>
            <div class="post_contents">
                <label for="title">タイトル</label><br>
                <input type="text" name="title" value="{{$post -> title}}"></input>
                @if($errors->first('title'))
                <span class="error_message">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="post_contents">
                <label for="post">投稿内容</label><br>
                <textarea type="text" name="post" value="{{$post -> post}}" class="post_box">{{$post -> post}}</textarea>
                @if($errors->first('post'))
                <span class="error_message">{{ $errors->first('post') }}</span>
                @endif
            </div>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="event_at" value="{{ now()->format('Y-m-d') }}">
            <div class="post_contents">
                <input type="submit" class="btn" value="更新">
                <input type="submit" class="btn" value="削除" form="delete">
            </div>
        </form>
        <form action="{{route('post.delete',['id' => $post->id] )}}" method="post" id="delete">@csrf</form>
    </div>
    @endforeach
</div>
@endsection

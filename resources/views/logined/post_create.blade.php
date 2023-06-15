@extends('logined.layouts.layout')

@section('content')
<div class="inner">
    <h2>新規投稿画面</h2>
</div>
<div class="post_contents_wrapper">
    <form action="" method="post">
        @csrf
        <div class="post_contents">
            <label for="sub_category_id">サブカテゴリ―</label>
            <select class="" name="sub_category_id">
                <option value="none">---</option>
                @foreach($main_categories as $main_category)
                <optgroup label="{{ $main_category->main_category }}">
                    <!-- <option value="none">---</option> -->
                    @foreach($main_category->sPostSubCategories as $sub_category)
                    <option value="{{ $sub_category->id }}">
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
            <label for="title">タイトル</label>
            <input type="text" name="title"></input>
            @if($errors->first('title'))
            <span class="error_message">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="post_contents">
            <label for="post">投稿内容</label>
            <input type="text" name="post"></input>
            @if($errors->first('post'))
            <span class="error_message">{{ $errors->first('post') }}</span>
            @endif
        </div>
        <input type="hidden" name="event_at" value="{{ now()->format('Y-m-d') }}">
        <div class="post_contents">
            <input type="submit" class="btn" value="投稿">
        </div>
    </form>
</div>

@endsection

@extends('logined.layouts.layout')

@section('content')
<div class="inner">
    <h2>新規投稿画面</h2>
</div>
<form action="" method="post">
    <label for="sub_category_id">サブカテゴリ―</label>
    <select class="" name="sub_category_id">
        @foreach($main_categories as $main_category)
        <optgroup label="{{ $main_category->main_category }}">
            <option value="none">---</option>
            @foreach($main_category->sub_categories as $sub_category)
            <option value="{{ $sub_category->id }}">{{ $sub_category->sub_category }}
            </option>
            @endforeach
        </optgroup>
        @endforeach
    </select>
    <label for="">タイトル</label>
    <input type="text" name="title"></input>
    <label for="post">投稿内容</label>
    <input type="text" name="post"></input>
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
</form>

@endsection

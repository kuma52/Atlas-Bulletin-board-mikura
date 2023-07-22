@extends('logined.layouts.layout')

@section('content')
<div class="inner">
    <h2>カテゴリー追加画面</h2>
    <div class="d-flex">
        <div class="box_wrapper mr-2">
            <div>
                <h2>新規メインカテゴリー</h2>
                <form action="{{ route('create.main.category') }}" method="post">
                    @csrf
                    <input type="text" name="new_main_category">
                    <input type="submit" value="追加">
                </form>
            </div>
            <div>
                <h2>メインカテゴリー</h2>
                <form action="{{ route('create.sub.category') }}" method="post">
                    @csrf
                    <div>
                        <select name="main_category" id="">
                            @foreach($main_categories as $main_category)
                            <option value="{{ $main_category->id }}">{{ $main_category->main_category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <h2>新規サブカテゴリー</h2>
                        <input type="text" name="new_sub_category">
                        <input type="submit" value="追加">
                    </div>
                </form>
            </div>
        </div>

        <div class="box_wrapper">
            <h2>カテゴリー一覧</h2>
            <div class="">
                @foreach($main_categories as $main_category)
                <div class="mb-2">
                    <p class="mb-0">{{ $main_category->main_category }}</p>
                    @foreach($main_category->sPostSubCategories as $sub_category)
                    <div class="d-flex">
                        <p class="btn_design mb-1 ml-2">{{ $sub_category->sub_category }}</p>
                        <input type="submit" form="SubCategoryEdit" value="削除" onclick="return confirm('削除します。よろしいですか？')">
                    </div>
                    <input type="hidden" name="sub_category_id" value="{{ $sub_category->id }}" form="SubCategoryEdit">
                    <form action="{{ route('delete.sub.category', ['id' => $sub_category->id]) }}" id="SubCategoryEdit" method="post">@csrf</form>
                    @endforeach
                </div>
                @endforeach
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

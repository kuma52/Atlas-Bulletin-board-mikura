@extends('auth.layouts.layout')

@section('content')

<div class="background"></div>
<div class="wrapper" id="login">
    <form method="POST">
        @csrf
        <h2>ログイン</h2>
        <div class="inner_element">
            <label for="name">メールアドレス</label><br>
            <input type="text" class="input" name="email" type="email">
        </div>
        <div class="inner_element">
            <label for="name">パスワード</label><br>
            <input type="password" class="input" name="password">
        </div>
        <div class="btn_wrapper">
            <input type="submit" class="btn" value="ログイン">
        </div>
        <p>新規ユーザー登録は<a href="register">こちら</a></p>
    </form>
</div>
@endsection

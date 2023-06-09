@extends('auth.layouts.layout')

@section('content')

<div class="wrapper" id="register">
    <form method="POST">
        @csrf
        <h2>ユーザー登録</h2>
        <div class="inner_element">
            <label for="username">ユーザー名</label><br>
            <input type="text" class="input" name="username" value="{{ old('username') }}">
            @if($errors->has('username'))
            <p class="error_message">{{ $errors->first('username') }}</p>
            @endif
        </div>
        <div class="inner_element">
            <label for="email">メールアドレス</label><br>
            <input type="text" class="input" name="email" type="email" value="{{ old('email') }}">
            @if($errors->has('email'))
            <p class="error_message">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="inner_element">
            <label for="password">パスワード</label><br>
            <input type="password" class="input" name="password">
            @if($errors->has('password'))
            <p class="error_message">{{ $errors->first('password') }}</p>
            @endif
        </div>
        <div class="inner_element">
            <label for="name">パスワード確認</label><br>
            <input type="password" class="input" name="password_confirmation">
        </div>
        <div class="btn_wrapper">
            <input type="submit" class="btn letter_space" value="確認">
        </div>

    </form>
</div>

@endsection

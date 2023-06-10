@extends('auth.layouts.layout')

@section('content')

<div class="wrapper" id="register">
    <form method="POST">
        @csrf
        <h2>ユーザー登録</h2>
        <div class="inner_element">
            <label for="name">ユーザー名</label><br>
            <input type="text" class="input" name="username" value="{{ old('username') }}">
            @if($errors->has('username'))
            <p class="error_message">{{ $errors->first('username') }}</p>
            @endif
        </div>
        <div class="inner_element">
            <label for="name">メールアドレス</label><br>
            <input type="text" class="input" name="email" type="email" value="{{ old('email') }}">
            @if($errors->has('email'))
            <p class="error_message">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="inner_element">
            <label for="name">パスワード</label><br>
            <input type="password" class="input" name="password">
            @if($errors->has('password'))
            <p class="error_message">{{ $errors->first('password') }}</p>
            @endif
        </div>
        <div class="inner_element">
            <label for="name">パスワード確認</label><br>
            <input type="password" class="input" name="password_confirmation">
            <!-- 検討　if($errors->first('password'))
    <p class="error_message">{{ $errors->first('password') }}</p>
    endif -->
        </div>
        <div class="btn_wrapper">
            <input type="submit" class="btn" value="確認">
        </div>

    </form>
</div>

@endsection

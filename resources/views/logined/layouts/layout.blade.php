<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="掲示板です">
    <title>AtlasBuiltinBoard</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/logined.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }} ">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!-- font-awesome -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>

<body>
    <header>
        <div id="menu">
            <nav class="nav">
                <div id="username">
                    <p>{{ Auth::user()->username }}<span class="small">さん</span></p>
                </div>
                <li>
                    <a href="/home" aria-describedby="tooltip-home">
                        <i class=" fas fa-home"></i>
                    </a>
                </li>
                <li>
                    <a href="/logout" aria-describedby="tooltip-logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
                <!-- ツールチップの内容 -->
                <!-- <div class="tooltip">
                    <span id="tooltipContent">ホームに移動</span>
                    <span id="tooltipContent">ログアウト</span>
                </div> -->
            </nav>
            <div class="nav">
                <div class="menu_trigger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </header>
    <div id="container">
        @yield('content')
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>

</html>

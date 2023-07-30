<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <title>AtlasSNS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
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
        <div id="head">
            <h1><a href="/top"><img class="header-image" src="{{asset('images/atlas.png')}}" width="100"></a></h1>
            <div class="accordion-container">
                <ul>
                    <li class="header-username">{{ Auth::user()->username }}　さん</li>
                    <li class="accordion-push"></li>
                </ul>
                <div class="menu-container">
                    <nav>
                        <ul class="menu-items">
                            <li class="home"><a href="/top">HOME</a></li>
                            <li class="profile"><a href="/profile">プロフィール編集</a></li>
                            <li class="logout"><a href="/logout">ログアウト</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="icon-container">
                    <div><img class="header-icon" src="{{ \Storage::url(Auth::user()->images) }}">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p class="side-name">{{ Auth::user()->username }}さんの</p>
                <div class="auth-follows">
                    <p>フォロー数</p>
                    <p class="count">{{ Auth::user()->follow()->get()->count() }}人</p>
                </div>
                <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                <div class="auth-follower">
                    <p>フォロワー数</p>
                    <p class="count">{{ Auth::user()->follower()->get()->count() }}人</p>
                </div>
                <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
            </div>
            <p class="btn-search"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('js/script.js' )}}"></script>

</body>

</html>

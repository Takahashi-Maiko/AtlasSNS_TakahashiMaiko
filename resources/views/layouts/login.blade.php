<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!-- ↓↓jQueryをリンクさせる。 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
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
        <div id = "head">
                <!-- ↓↓Atlasロゴにトップページへ遷移するリンクを設置する -->
        <h1><a href="/top"><img src="images/atlas.png" alt="Atlas"></a></h1>
        <!-- ↓↓ログイン後のページでの名前の表示 -->
        <p>{{  Auth::user()->username  }}  さん</p>

        <!-- ↓↓アコーディオンメニュー -->
            <div class="accordion">
                <div class="accordion-switch"> </div>
                  <div class="accordion-contents">
                    <ul>
                        <li class="box1"><a href="/top">HOME</a></li>
                        <li class="box2"><a href="/profile">プロフィール編集</a></li>
                        <li class="box3"><a href="/logout">ログアウト</a></li>
                    </ul>
                 </div>
            </div>
         <div class="icon"><img src="{{asset('storage/images/'.Auth::user()->images)}}"></div>
        </div>
    </header>

    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>{{  Auth::user()->username  }}さんの</p>
                <div>
                <p>フォロー数</p>
                <p>{{  Auth::user()->follows()->count()  }}人</p>
                </div>
                <!-- <p class="btn"><a href="/follow-list">フォローリスト</a></p> -->
                <div class="button-container">
                <button type="button" class="btn-follow-list"><a href="/follow-list">フォローリスト</a></button>
                </div>
                <div>
                <p>フォロワー数</p>
                <p>{{  Auth::user()->followers()->count()  }}人</p>
                </div>
                <!-- <p class="btn"><a href="./follower-list">フォロワーリスト</a></p> -->
                <div class="button-container">
                <button type="button" class="btn-follower-list"><a href="./follower-list">フォロワーリスト</a></button>
                </div>
            </div>
            <div class="search_button">
            <!-- <p class="btn"><a href="search">ユーザー検索</a></p> -->
                <button type="button" class="btn-search"><a href="search">ユーザー検索</a></button>
            </div>
        </div>
    </div>


    <footer>
    </footer>
    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>

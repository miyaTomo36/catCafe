<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Scripts -->
        <script src="{{ secure_asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            
            <!-- ヘッダー -->
            <header class="header">
                <!-- ロゴ -->
                <div class="header-area">
                    <div class="header-left">
                        <a class="header-logo">
                            <img src="{{ asset('/assets/images/500x100.png') }}" height="25px" alt="ロゴ">
                        </a>
                    </div>
                    <!-- ログイン -->
                    <ul class="navbar-nav ml-auto">
                        <!-- ログインしていない場合はリンク表示 -->
                        @guest
                        <li>
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <!-- ログインしている場合はユーザー名とログアウトボタン表示 -->
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
                
                <!-- ナビゲーションバー -->
                <nav class="nav">
                    <ul class="navber">
                        <li class="nav-list">
                            <a href="{{ action('Admin\BlogController@index') }}">Blog</a>
                        </li>
                        <li class="nav-list">
                            <a href="{{ action('Admin\CatController@index') }}">Cats</a>
                        </li>
                        <li class="nav-list">
                            <a href="{{ action('Admin\DrinkController@index') }}">Drink</a>
                        </li>
                        <li class="nav-list">
                            <a href="{{ action('Admin\GoodsController@index') }}">Goods</a>
                        </li>
                        <li class="nav-list">
                            <a href="#">User</a>
                        </li>
                    </ul>
                </nav>
            </header>
            
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
</html>
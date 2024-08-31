<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <div class="header__left">
            <span class="header__logo">
                Atte
            </span>
        </div>
        @if (Auth::check())
        <div class="header__left">
            <a class="header__item-link" href="/">ホーム</a>
            <form class="form" action="/logout" method="post">
                @csrf
                <button type="submit" class="header__item-link">
                    ログアウト
                </button>
            </form>
        </div>
        @endif
    </header>
    {{-- "{{ route('logout') }}" --}}

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer__item">
            <small class="footer__text">
                Atte,inc.
            </small>
        </div>
    </footer>
</body>

</html>

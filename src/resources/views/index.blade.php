@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="header__wrap">
        <p class="header__text">
            {{ \Auth::user()->name }}さんお疲れ様です！
        </p>
    </div>

<body>
<div class="container">
    {{-- 勤務開始 --}}
    <form class="form__work" action="/start_work" method="post">
        @csrf
        <div class="form__item">
            <button class="form__item-button" type="submit" name="start_work">勤務開始
            </button>
        </div>
    </form>
    {{-- 勤務終了 --}}
    <form class="form__work" action="/end_work" method="post">
        @csrf
        <div class="form__item">
            <button class="form__item-button" type="submit" name="end_work">勤務終了
            </button>
        </div>
    </form>
    {{-- 休憩開始 --}}
    <form class="form__start-rest" action="/start_rest" method="post">
        @csrf
        <div class="form__item">
            <button class="form__item-button" type="submit" name="start_work">休憩開始
            </button>
        </div>
    </form>
    {{-- 休憩終了 --}}
    <form class="form__end-rest" action="/end_rest" method="post">
        @csrf
        <div class="form__item">
            <button class="form__item-button" type="submit" name="end_rest">休憩終了
            </button>
        </div>
    </form>
</div>
@endsection

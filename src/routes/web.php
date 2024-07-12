<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\RestController;

//ログインホーム
Route::get('/', [AuthenticatedSessionController::class, 'punch'])
    ->middleware('auth', 'verified');

//打刻ページ表示
Route::get('/', [WorkController::class, 'index'])
    ->middleware('auth');

//勤務開始ボタンを押し、勤務開始日時を保存
Route::post('/start_work', [WorkController::class, 'start_work'])->name('start_work');

//勤務終了ボタンを押し、勤務終了日時を保存
Route::post('/end_work', [WorkController::class, 'end_work'])->name('end_work');

//休憩開始ボタンを押し、休憩開始日時を保存
Route::post('/start_rest', [RestController::class, 'start_rest'])->name('start_rest');

//休憩終了ボタンを押し、休憩終了日時を保存
Route::post('/end_rest', [RestController::class, 'end_rest'])->name('end_rest');

// ログアウト
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

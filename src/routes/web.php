<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\RestController;

//打刻ページ表示
Route::get('/', [WorkController::class, 'index'])
    ->middleware('auth');

//勤務開始ボタンを押し、勤務開始日時を保存
Route::post('/start_work', [WorkController::class, 'startWork'])->name('work.start');

//勤務開始ボタンを押し、勤務終了日時を保存
Route::post('/end_work', [WorkController::class, 'endWork'])->name('work.end');

//休憩開始ボタンを押し、休憩開始日時を保存
Route::post('/start_rest', [RestController::class, 'startRest'])->name('rest.start');

//休憩終了ボタンを押し、休憩終了日時を保存
Route::post('/end_rest', [RestController::class, 'endRest'])->name('rest.end');

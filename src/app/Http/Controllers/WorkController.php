<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use Illuminate\Support\Carbon;

class WorkController extends Controller
{
    // 打刻ページ表示
    public function index()
    {
        $works = Work::all();

        return view('index', ['works' => $works]);
    }

    // 勤務開始時間の保存
    public function startWork(Request $request)
    {
        $today = Carbon::today();
        $userId = auth()->id();

        // 今日の勤務記録が存在するか確認
        $work = Work::where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->first();
        // 既に出勤している場合はエラーを返す
        if ($work) {
            return redirect()->back()->with('error', '既に本日の勤務開始記録があります。');
        }

        // 新しい勤務記録を作成
        $work = new Work();
        $work->user_id = $userId;
        $work->work_start_time = Carbon::now();
        $work->save();

        return redirect('/');
    }

    // 勤務終了時間の保存
    public function endWork(Request $request)
    {
        $today = Carbon::today();
        $userId = auth()->id();

        // 今日の出勤記録を取得
        $work = Work::where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->first();

        // 出勤記録が存在しない場合や既に退勤している場合はエラーを返す
        if (!$work || $work->work_end_time) {
            return redirect()->back()->with('error', '勤務開始記録がないか、既に勤務終了済みです。');
        }

        // 退勤時間を設定
        $work->work_end_time = Carbon::now();
        $work->save();

        return redirect('/');
        }
}


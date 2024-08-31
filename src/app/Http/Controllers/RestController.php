<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Rest;
use Illuminate\Support\Carbon;

class RestController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $today = Carbon::today();

        // 今日の勤務記録を取得
        $work = Work::where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->first();

        // 休憩関連の情報を取得
        $canStartRest = false;
        $canEndRest = false;

        if ($work) {
            $existingRest = Rest::where('work_id', $work->id)
                ->whereNull('rest_end_time')
                ->first();

            if ($existingRest) {
                // 休憩が開始されていて、終了していない場合
                $canEndRest = true;
            } else {
                // 休憩が終了しているか、まだ開始されていない場合
                $canStartRest = true;
            }
        }

        return view('/', compact('canStartRest', 'canEndRest'));
    }

    // 休憩開始時間の保存
    public function startRest(Request $request)
    {
        $today = Carbon::today();
        $userId = auth()->id();

        // 今日の勤務記録を取得
        $work = Work::where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->first();

        // 未完了の休憩記録をチェック
        $existingRest = Rest::where('work_id', $work->id)
            ->whereNull('rest_end_time')
            ->first();

        //連続で休憩開始時間だけで保存されないように制御
        if ($existingRest) {
            return redirect()->back()->withErrors('error', '休憩中です。休憩終了してから新たに休憩開始してください。');
        }

        // 新しい休憩レコードを作成
        $rest = new Rest();
        $rest->work_id = $work->id; // 外部キーを設定
        $rest->rest_start_time = Carbon::now();
        $rest->save();
        return redirect('/');
    }

    // 休憩終了時間の保存
    public function endRest(Request $request)
    {
        $today = Carbon::today();
        $userId = auth()->id();

        // 今日の未完了の休憩を取得
        // Workテーブルから該当する勤務記録を取得
        $work = Work::where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->first();

        // 取得した勤務記録のwork_idを使って、Restテーブルから未完了の休憩を取得
        if ($work) {
            $rest = Rest::where('work_id', $work->id)
                ->whereNull('rest_end_time') // 終了時間が未設定のもの
                ->orderBy('rest_start_time', 'desc')
                ->first();
        }

        //連続で休憩終了時間だけで保存されないように制御
        if ($rest->rest_end_time) {
            return redirect()->back()->withErrors(['error' => '休憩が開始されていないか、既に終了しています。']);
        }

        //休憩終了時間を設定
        $rest->rest_end_time = Carbon::now();
        $rest->save();
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class WorkController extends Controller
{
    //打刻ページ表示
    public function index()
    {
        $works = Work::all();
        return view('index', ['works' => $works]);
    }

    //勤務開始ボタンを押して勤務開始日時を保存する処理
    public function start_Work(Request $request)
    {
        $work = new Work();
        $work->work_start_time = Carbon::now();
        $work->user_id = auth()->id();
        $work->save();
        return redirect('/');
    }

    //勤務終了ボタンを押して勤務終了日時を保存する処理
    public function end_Work(Request $request)
    {
        $work = new Work();
        $work->work_end_time = Carbon::now();
        $work->user_id = auth()->id();
        $work->save();
        return redirect('/');
    }

    // 更新機能
    public function update(Request $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Work::find($request->id)->update($form);
        return redirect('/');
    }
}

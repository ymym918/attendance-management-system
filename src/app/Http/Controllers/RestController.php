<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class RestController extends Controller
{
    //休憩開始ボタンを押して休憩開始日時を保存する処理
    public function start_Rest(Request $request)
    {
        $rest = new Rest();
        $rest->work_id = Auth::id();
        $rest->rest_start_time = Carbon::now();
        $rest->save();
        return redirect('/');
    }

    //休憩終了ボタンを押して休憩終了日時を保存する処理
    public function end_Rest(Request $request)
    {
        $rest = new Rest();
        $rest->work_id = Auth::id();
        $rest->rest_end_time = Carbon::now();
        $rest->save();
        return redirect('/');
    }
}


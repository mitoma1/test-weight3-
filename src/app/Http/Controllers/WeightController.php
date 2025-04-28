<?php


// app/Http/Controllers/WeightController.php

namespace App\Http\Controllers;

use App\Http\Requests\WeightRequest;  // バリデーションリクエストを使う場合
use Illuminate\Http\Request;
use App\Models\WeightLog; // Import the WeightLog model

class WeightController extends Controller
{
    // 初期体重登録画面を表示
    public function create()
    {
        return view('auth.register_step2');
        $weightLogs = WeightLog::where('user_id', auth()->id())->get();

        return view('weight.index', compact('weightLogs'));
    }

    // 体重データの保存
    public function store(WeightRequest $request)
    {
        // バリデーション済みのデータを取得
        $data = $request->validated();

        // 体重データを保存（WeightLog モデルを使って保存）
        // 仮に WeightLog モデルがある場合
        // WeightLog::create($data);

        // 次のステップに遷移
        return redirect()->route('weight_logs.index');  // 例えば次のステップのルートへ遷移
    }
    public function index()
    {
        $weightLogs = WeightLog::where('user_id', auth()->id())->paginate(7); // ←ページネーションにしてね
        $targetWeight = 45.0; // 仮に45kg
        $latestWeight = optional($weightLogs->first())->weight ?? null;
        $targetDifference = $latestWeight ? $latestWeight - $targetWeight : null;

        return view('weight.index', compact('weightLogs'));
    }
}

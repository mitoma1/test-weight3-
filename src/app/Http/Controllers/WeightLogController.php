<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\WeightLogRequest; // バリデーション用フォームリクエスト

class WeightLogController extends Controller
{
    // 体重ログの一覧表示
    public function index(Request $request)
    {
        $query = WeightLog::where('user_id', Auth::id());

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $logs = $query->orderBy('date', 'desc')->paginate(8);

        $latestWeightLog = WeightLog::where('user_id', Auth::id())->orderBy('date', 'desc')->first();
        $latestWeight = $latestWeightLog ? $latestWeightLog->weight : null;

        $targetWeightRecord = WeightTarget::where('user_id', Auth::id())->first();
        $targetWeight = $targetWeightRecord ? $targetWeightRecord->target_weight : null;

        $targetDifference = null;
        if ($latestWeight !== null && $targetWeight !== null) {
            $targetDifference = number_format($latestWeight - $targetWeight, 1);
        }

        return view('weight_logs.index', [
            'logs' => $logs,
            'targetWeight' => $targetWeight,
            'latestWeight' => $latestWeight,
            'targetDifference' => $targetDifference,
        ]);
    }

    // 一覧画面（フォームリクエスト版対応）
    public function list()
    {
        $weightLogs = WeightLog::orderBy('date', 'desc')->get();
        return view('weight_logs.index', compact('weightLogs'));
    }

    // 新しい体重ログを作成するフォーム
    public function create()
    {
        $weightLog = new WeightLog();
        return view('weight_logs.create', compact('weightLog'));
    }

    // 新規登録処理（フォームリクエスト使用）
    public function store(WeightLogRequest $request)
    {

        WeightLog::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index')->with('success', '登録しました！');
    }

    // 体重ログの編集フォーム
    public function edit($id)
    {
        $log = WeightLog::findOrFail($id);
        return view('weight_logs.edit', compact('log'));
    }

    // 更新処理（フォームリクエスト使用）
    public function update(WeightLogRequest $request, $id)
    {
        $log = WeightLog::findOrFail($id);

        $log->update([
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_description' => $request->exercise_description,
        ]);

        return redirect()->route('weight_logs.index')->with('success', '更新しました！');
    }

    // 削除処理
    public function destroy($id)
    {
        $log = WeightLog::findOrFail($id);
        $log->delete();

        return redirect()->route('weight_logs.index')->with('success', '削除しました！');
    }

    // 体重ログの検索
    public function search(Request $request)
    {
        $query = WeightLog::where('user_id', Auth::id());

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        }

        $logs = $query->orderBy('date', 'desc')->paginate(10);

        return view('weight_logs.index', compact('logs'));
    }

    // 目標体重の設定画面
    public function goalSetting()
    {
        $targetWeight = WeightTarget::where('user_id', Auth::id())->first();
        $currentGoalWeight = $targetWeight ? $targetWeight->target_weight : null;

        return view('weight_logs.goal_setting', compact('currentGoalWeight'));
    }

    // 目標体重の更新処理
    public function updateGoalWeight(Request $request)
    {
        $request->validate([
            'goal_weight' => 'required|numeric|regex:/^\d+(\.\d{1})?$/',
        ], [
            'goal_weight.required' => '目標の体重を入力してください',
            'goal_weight.numeric'  => '4桁までの数字で入力してください',
            'goal_weight.regex'    => '小数点は1桁で入力してください',
        ]);



        // 更新 or 作成
        WeightTarget::updateOrCreate(
            ['user_id' => Auth::id()],
            ['target_weight' => $request->goal_weight]
        );


        return redirect()->route('weight_logs.index');
    }
}

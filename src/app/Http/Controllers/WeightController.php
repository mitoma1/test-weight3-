<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WeightRequest;

class WeightController extends Controller
{
    // 体重登録画面表示
    public function create()
    {
        return view('auth.register_step2');
    }

    // 登録処理
    public function store(WeightRequest $request)
    {
        // ユーザーに体重情報を登録（例: ユーザーテーブルに current_weight, target_weight カラムがある前提）
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->withErrors('ログインしてください');
        }

        // 正常処理
        $user->update([
            'current_weight' => $request->current_weight,
            'target_weight'  => $request->target_weight,
        ]);

        return redirect()->route('weight.register.step2')->with('success', '体重が登録されました！');
    }
}

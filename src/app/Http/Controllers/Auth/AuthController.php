<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // 必要に応じてUserモデルを使用

class AuthController extends Controller
{
    // Step 2: 初期体重登録画面の表示
    public function step2()
    {
        return view('auth.register_step2'); // view('auth.register_step2') に対応するビューを表示
    }

    // Step 2: 初期体重のデータを保存
    public function registerStep2(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'initial_weight' => 'required|numeric|min:10|max:500', // 体重は必須、数値で、10kg以上500kg以下
        ]);

        // ユーザーに初期体重を保存（例: ユーザーの登録情報に保存）
        $user = auth()->user(); // 現在ログインしているユーザー
        $user->initial_weight = $validated['initial_weight'];
        $user->save();

        // 次のステップへ進む場合や完了後のリダイレクト
        return redirect()->route('some_next_step'); // 必要に応じて遷移先を変更
    }
}

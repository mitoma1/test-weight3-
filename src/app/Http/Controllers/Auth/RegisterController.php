<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterStep1Request; // 作成するフォームリクエスト

class RegisterController extends Controller
{
    // Step1の表示
    public function showStep1()
    {
        return view('auth.register-step1');
    }

    // Step1の処理
    public function processStep1(RegisterStep1Request $request)
    {
        // バリデーション成功後の処理
        // ユーザー情報をセッションに保存（次のステップで使用）
        session([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // パスワードをハッシュ化
        ]);

        return redirect()->route('register.step2'); // 次のステップへ
    }
}

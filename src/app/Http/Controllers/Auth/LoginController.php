<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('weight_logs.index');  // 体重管理画面
        }

        return back()->withErrors(['email' => 'メールアドレスかパスワードが正しくありません。'])
            ->withInput();
    }
    public function logout(Request $request)
    {
        Auth::logout();  // 認証情報をクリアする
        $request->session()->invalidate();  // セッションを無効にする
        $request->session()->regenerateToken();  // セッションのCSRFトークンを再生成する

        return redirect('/');  // ログアウト後のリダイレクト先（ホームページやログインページ）
    }
}

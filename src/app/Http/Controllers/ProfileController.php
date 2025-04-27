<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Ensure the User model is imported

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();  // 現在ログインしているユーザーの情報を取得
        return view('profile.edit', compact('user'));
    }

    // 情報を更新
    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            throw new \Exception('Authenticated user is not an instance of User model.');
        }

        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // 他のフィールドのバリデーション（例：パスワード、プロフィール画像）
        ]);

        // ユーザー情報を更新
        $user->name = $request->name;
        $user->email = $request->email;
        // 他のフィールドも必要に応じて更新

        // 画像の更新（もし必要なら）
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('public/profile_images');
            $user->profile_image = $path;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', '情報が更新されました');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStep1Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterStep1Controller extends Controller
{
    public function show()
    {
        return view('auth.register-step1');
    }

    public function register(RegisterStep1Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); // 自動ログイン

        return redirect()->route('weight.register.step2');
    }
}

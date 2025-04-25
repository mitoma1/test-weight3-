@extends('layouts.app')

@section('styles')
<!-- 個別ページ用のCSSファイルを追加 -->
<link rel="stylesheet" href="{{ asset('css/register-step1.css') }}">
@endsection

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-100 to-pink-300">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h1 class="text-4xl font-bold text-pink-500 text-center mb-2">PiGLy</h1>
        <p class="text-center text-gray-700 mb-6">新規会員登録</p>
        <p class="text-center text-sm text-gray-500 mb-8">STEP1 アカウント情報の登録</p>

        <form method="POST" action="{{ route('register.step1.post') }}">
            @csrf

            {{-- 名前 --}}
            <div class="mb-4">
                <label for="name" class="block mb-1 font-semibold text-gray-700">お名前</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    placeholder="名前を入力"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-pink-300">
                @error('name')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- メール --}}
            <div class="mb-4">
                <label for="email" class="block mb-1 font-semibold text-gray-700">メールアドレス</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    placeholder="メールアドレスを入力"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-pink-300">
                @error('email')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- パスワード --}}
            <div class="mb-6">
                <label for="password" class="block mb-1 font-semibold text-gray-700">パスワード</label>
                <input type="password" name="password" id="password"
                    placeholder="パスワードを入力"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-pink-300">
                @error('password')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ボタン --}}
            <div class="mb-4">
                <button type="submit"
                    class="w-full py-2 text-white rounded bg-gradient-to-r from-pink-400 to-purple-400 hover:opacity-90 transition">
                    次に進む
                </button>
            </div>
        </form>

        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm text-blue-500 hover:underline">
                ログインはこちら
            </a>
        </div>
    </div>
</div>
@endsection
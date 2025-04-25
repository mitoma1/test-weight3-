@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/register_step2.css') }}">
@endsection

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-100 via-purple-100 to-pink-300 px-4">
    <div class="bg-white p-10 rounded-3xl shadow-2xl w-full max-w-md">
        <h1 class="text-5xl font-semibold text-center text-pink-400 mb-2 tracking-wider">PiGLy</h1>
        <h2 class="text-xl text-center text-gray-700 font-medium mb-1">新規会員登録</h2>
        <p class="text-center text-sm text-gray-500 mb-8">STEP2 体重データの入力</p>

        <form method="POST" action="{{ route('weight.store.step2') }}">
            @csrf

            {{-- 現在の体重 --}}
            <div class="mb-6">
                <label for="current_weight" class="block mb-2 text-sm font-semibold text-gray-800">現在の体重</label>
                <div class="relative">
                    <input type="text" name="current_weight" id="current_weight"
                        value="{{ old('current_weight') }}"
                        placeholder="現在の体重を入力"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm pr-12 focus:ring-2 focus:ring-pink-300 focus:outline-none transition">
                    <span class="absolute right-4 top-2.5 text-gray-500">kg</span>
                </div>
                @error('current_weight')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- 目標の体重 --}}
            <div class="mb-6">
                <label for="target_weight" class="block mb-2 text-sm font-semibold text-gray-800">目標の体重</label>
                <div class="relative">
                    <input type="text" name="target_weight" id="target_weight"
                        value="{{ old('target_weight') }}"
                        placeholder="目標の体重を入力"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm pr-12 focus:ring-2 focus:ring-pink-300 focus:outline-none transition">
                    <span class="absolute right-4 top-2.5 text-gray-500">kg</span>
                </div>
                @error('target_weight')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ボタン --}}
            <div class="mt-8">
                <button type="submit"
                    class="w-full py-2 rounded-lg text-white font-semibold bg-gradient-to-r from-purple-300 to-pink-300 hover:from-purple-400 hover:to-pink-400 transition-all duration-300 shadow-md">
                    アカウント作成
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
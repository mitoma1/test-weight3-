<?php

use App\Http\Controllers\Auth\RegisterStep1Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WeightController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 未認証のユーザーのみアクセスできるように guest ミドルウェアを適用
Route::get('/register/step1', [RegisterStep1Controller::class, 'show'])->name('register.step1');
Route::post('/register/step1', [RegisterStep1Controller::class, 'register'])->name('register.step1.post');

// 初期体重登録
Route::get('/register/step2', [WeightController::class, 'create'])->name('weight.register.step2');
Route::post('/register/step2', [WeightController::class, 'store'])->name('weight.store.step2');

// ログイン
Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
// ログアウト
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

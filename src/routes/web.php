<?php

use App\Http\Controllers\Auth\RegisterStep1Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\WeightLogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/register/step1', [RegisterStep1Controller::class, 'show'])->name('register.step1');
Route::post('/register/step1', [RegisterStep1Controller::class, 'register'])->name('register.step1.post');

Route::get('/register/step2', [WeightController::class, 'create'])->name('weight.register.step2');
Route::post('/register/step2', [WeightController::class, 'store'])->name('weight.store.step2');

Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 体重ログ一覧ページ
Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');

// 体重ログ登録ページ
Route::get('/weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');

// 体重ログ登録処理
Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');

// 体重ログ詳細ページ (もし必要ならここも作るけど今はスキップ)

// 体重ログ更新ページ
Route::get('/weight_logs/{weightLogId}/edit', [WeightLogController::class, 'edit'])->name('weight_logs.edit');

// 体重ログ更新処理
Route::put('/weight_logs/{weightLogId}', [WeightLogController::class, 'update'])->name('weight_logs.update');

// 体重ログ削除処理
Route::delete('/weight_logs/{weightLogId}', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');

// 目標設定ページ
Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'goalSetting'])->name('weight_logs.goal_setting');
Route::post('/weight_logs/goal_setting', [WeightLogController::class, 'updateGoalWeight']);
// 体重検索ページ
Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');

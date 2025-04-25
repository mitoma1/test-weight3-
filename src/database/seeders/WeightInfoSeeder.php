<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;

class WeightInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first(); // すでに存在するユーザーを取得する場合

        if (!$user) {
            // ユーザーが存在しない場合、デフォルトで作成する
            $user = User::factory()->create();
        }

        // 体重目標のダミーデータ作成
        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => 70.5, // 目標体重
        ]);

        // 35件の体重ログデータ作成
        \App\Models\WeightLog::factory()->count(35)->create([
            'user_id' => $user->id,
        ]);
    }
}

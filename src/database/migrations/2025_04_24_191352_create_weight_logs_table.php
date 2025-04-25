<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_logs', function (Blueprint $table) {
            $table->bigIncrements('id'); // 主キー
            $table->unsignedBigInteger('user_id'); // 外部キー: usersテーブルのid
            $table->date('date'); // 日付
            $table->decimal('weight', 4, 1); // 体重
            $table->integer('calories')->nullable(); // 食事量（nullable: 任意）
            $table->time('exercise_time')->nullable(); // 運動時間（nullable: 任意）
            $table->text('exercise_content')->nullable(); // 運動内容（nullable: 任意）
            $table->timestamps(); // created_at, updated_at

            // 外部キー制約（usersテーブルのidと紐づけ）
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weight_logs');
    }
}

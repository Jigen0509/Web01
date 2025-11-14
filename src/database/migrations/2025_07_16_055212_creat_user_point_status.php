<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_point_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('point_id')->constrained('points')->cascadeOnDelete(); // ポイントIDを外部キーとして参照し、ポイントが削除された場合は関連する投稿も削除される
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // ユーザーIDを外部キーとして参照し、ユーザーが削除された場合は関連する投稿も削除される
            $table->integer('point_earned')->default(0); // 獲得ポイント数
            $table->boolean('is_cleared')->default(false); // クリア状態（クイズ全問正解）
            $table->date('visit_date')->nullable(); // 訪問日
            $table->date('clear_date')->nullable(); // クリア日（クイズ全問正解日）
            $table->boolean('quiz_cleared')->default(false); // クイズクリア状態を示すブール型 デフォルトは未クリア(false)
            $table->boolean('photo_cleared')->default(false); // 写真ミッションクリア状態を示すブール型、デフォルトは未クリア(false)
            $table->date('quiz_clear_date')->nullable(); // クイズクリア日を格納する日付型、null許容
            $table->date('photo_clear_date')->nullable(); // 写真ミッションクリア日を格納する日付型、null許容
            $table->timestamps(); // created_atとupdated_atのタイムスタンプを自動的に管理する
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

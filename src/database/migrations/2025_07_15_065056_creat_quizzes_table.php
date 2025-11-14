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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->text('question_text'); // stringは可変長の文字列型
            $table->foreignId('point_id')->constrained('points')->cascadeOnDelete(); // ポイントIDを外部キーとして参照し、ポイントが削除された場合は関連する投稿も削除される
            $table->string('correct_answer'); // 正解の回答を格納する文字列型
            $table->string('option1')->nullable(); // 選択肢1を格納する文字列型
            $table->string('option2')->nullable(); // 選択肢2を格納する文字列型
            $table->string('option3')->nullable(); // 選択肢3を格納する文字列型
            $table->timestamps(); // created_atとupdated_atのタイムスタンプを自動的に管理する


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes'); // quizzesテーブルを削除
    }
};

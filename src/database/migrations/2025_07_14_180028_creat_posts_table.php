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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('body'); // stringは可変長の文字列型
            $table->string('category'); // categoryを格納する文字列型
            $table->string('title'); // タイトルを格納する文字列型
            $table->string('image_path')->nullable(); // 場所画像パスを格納する文字列型
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // ユーザーIDを外部キーとして参照し、ユーザーが削除された場合は関連する投稿も削除される
            $table->foreignId('point_id')->constrained('points')->cascadeOnDelete(); // ポイントIDを外部キーとして参照し、ポイントが削除された場合は関連する投稿も削除される
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

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20); //stringは可変長の文字列型
            $table->string('email')->unique(); // ユニーク制約(emailは一意でなければならない)
            $table->string('password'); // パスワードはハッシュ化されるため、長さは適切に設定する必要があります
            $table->integer('total_point'); // ユーザーの総ポイントを格納する整数型
            $table->string('rank'); // ユーザーのランクを格納する文字列型
            $table->timestamp('email_verified_at')->nullable(); // メールアドレスの検証日時を格納するタイムスタンプ型（nullableはNULLを許可する）
            $table->string('image_path'); // ユーザーの画像パスを格納する文字列型
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

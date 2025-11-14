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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //stringは可変長の文字列型
            $table->string('image_path')->nullable(); // 場所の画像パスを格納する文字列型
            $table->double('latitude'); // 緯度を格納する浮動小数点型
            $table->double('longitude'); // 経度を格納する浮動小数点型
            $table->text('description'); // 説明を格納する文字列型（長文対応のため text に変更）
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

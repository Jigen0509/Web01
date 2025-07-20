<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany; // Use HasMany for the relationship with UserPointStatus and Post




class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', // ユーザー名
        'email', // メールアドレス
        'password', // パスワード
        'image_path', // 画像パス
        'total_point', // 総ポイント
        'rank', // ランク
    ];

    protected $hidden = [
        'password', // パスワードはハッシュ化されているため、通常は表示しない
        //'remember_token',//「ログインを記憶する」機能で使用されるトークン(使用するかは不明)
    ];

    protected $casts = [
        'email_verified_at' => 'datetime', // email_verified_atは日付型として扱う
        'created_at' => 'datetime', // created_atは日付型として扱う
        'updated_at' => 'datetime', // updated_atは日付型として扱う
        'password' => 'hashed', // パスワードはハッシュ化されているため、ハッシュ型として扱う
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class); // ユーザーは複数の投稿を持つ
    }

    public function userPointStatuses(): HasMany
    {
        return $this->hasMany(UserPointStatus::class); // ユーザーは複数のポイントステータスを持つ
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body', // 投稿内容
        'image_path', // 画像パス
        'title', // 投稿タイトル
        'category', // 投稿カテゴリー
        'point_id', // ポイントID   
    ];

    protected $casts = [
        'created_at' => 'datetime', // created_atは日付型として扱う
        'updated_at' => 'datetime', // updated_atは日付型として扱う
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); // 投稿は1人のユーザーに属する
    }

    public function point(): BelongsTo
    {
        return $this->belongsTo(Point::class); // 投稿は1つのポイントに属する
    }
}

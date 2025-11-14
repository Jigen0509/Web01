<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPointStatus extends Model
{
    use HasFactory;



    protected $table = 'user_point_status'; // テーブル名を指定

    protected $fillable = [
        'point_id',
        'user_id',
        'quiz_cleared',
        'photo_cleared',
        'quiz_clear_date', // クイズクリア日
        'photo_clear_date', // 画像クリア日
    ];

    protected $casts = [
        'quiz_cleared' => 'boolean',
        'photo_cleared' => 'boolean',
        'quiz_clear_date' => 'date',
        'photo_clear_date' => 'date',
        'created_at' => 'datetime', // created_atは日付型として扱う
        'updated_at' => 'datetime', // updated_atは日付型として扱う
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); // ポイントステータスは1人のユーザーに属する
    }

    public function point(): BelongsTo
    {
        return $this->belongsTo(Point::class); // ポイントステータスは1つの投稿に属する
    }
}

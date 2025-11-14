<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
        'image_path',
    ];

    protected $casts = [
        'created_at' => 'datetime', // created_atは日付型として扱う
        'updated_at' => 'datetime', // updated_atは日付型として扱う
    ];

    public function userPointStatuses(): HasMany
    {
        return $this->hasMany(UserPointStatus::class); // ポイントは複数のポイントステータスを持つ
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class); // ポイントは複数の投稿を持つ
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class); // ポイントは複数のクイズを持つ
    }
}

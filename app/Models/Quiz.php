<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'option1', // 選択肢1
        'option2', // 選択肢2
        'option3', // 選択肢3
    ];

    protected $casts = [
        'created_at' => 'datetime', // created_atは日付型として扱う
        'updated_at' => 'datetime', // updated_atは日付型として扱う
        'option1' => 'string', // 選択肢1は文字列として扱う
        'option2' => 'string', // 選択肢2は文字列として扱う
        'option3' => 'string', // 選択肢3は文字列として扱う
    ];

    public function point(): BelongsTo
    {
        return $this->belongsTo(Point::class); // クイズは1つのポイントに属する
    }
}

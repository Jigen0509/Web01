<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Starting direct seed...\n";

// 外部キー制約を無効化
\Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
echo "Foreign key checks disabled\n";

// Pointsテーブルをクリア
\Illuminate\Support\Facades\DB::table('points')->truncate();
echo "Points table truncated\n";

// 外部キー制約を有効化
\Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
echo "Foreign key checks enabled\n";

// 和白干潟を追加
$point = \App\Models\Point::create([
    'name' => '和白干潟',
    'description' => '江戸時代、福岡藩の命により「元禄堤防」が築かれ、大規模な塩田(和白塩田)が作られました。',
    'latitude' => 33.6833,
    'longitude' => 130.4167,
    'image_path' => null,
]);

echo "Point created: " . $point->name . " (ID: " . $point->id . ")\n";

// 確認
$count = \App\Models\Point::count();
echo "Total points in database: $count\n";

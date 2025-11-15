<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// データ取得確認
$points = \App\Models\Point::orderBy('name')->paginate(10);

echo "=== DATABASE CHECK ===\n";
echo "Points count: " . $points->count() . "\n";
echo "Points total: " . $points->total() . "\n\n";

echo "=== POINTS DATA ===\n";
foreach ($points as $point) {
    echo "ID: {$point->id}, Name: {$point->name}\n";
}

// ビューの変数を確認
echo "\n=== VIEW VARIABLES ===\n";
echo "isset(\$points): " . (isset($points) ? "true" : "false") . "\n";
echo "\$points->count() > 0: " . ($points->count() > 0 ? "true" : "false") . "\n";

// ビューの条件を再現
echo "\n=== VIEW CONDITION ===\n";
if (isset($points) && $points->count() > 0) {
    echo "✅ Condition is TRUE - Points should be displayed\n";
    echo "First point for display test:\n";
    $firstPoint = $points->first();
    echo "  - Name: {$firstPoint->name}\n";
    echo "  - ID: {$firstPoint->id}\n";
    echo "  - Route would be: /points/{$firstPoint->id}\n";
} else {
    echo "❌ Condition is FALSE - 'No points' message would be shown\n";
}

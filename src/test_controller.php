<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Testing PointController logic...\n\n";

// コントローラーと同じロジックでデータ取得
$points = \App\Models\Point::orderBy('name')->paginate(10);

echo "Points count: " . $points->count() . "\n";
echo "Points total: " . $points->total() . "\n";
echo "Current page: " . $points->currentPage() . "\n\n";

if ($points->count() > 0) {
    echo "Points data:\n";
    foreach ($points as $point) {
        echo "- ID: {$point->id}, Name: {$point->name}\n";
    }
} else {
    echo "No points returned by paginate!\n";
}

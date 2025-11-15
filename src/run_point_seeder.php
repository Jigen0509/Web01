<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Running PointSeeder directly...\n";

$seeder = new \Database\Seeders\PointSeeder();
$seeder->run();

echo "PointSeeder completed\n";

// 確認
$count = \App\Models\Point::count();
echo "Total points in database: $count\n";

if ($count > 0) {
    echo "\nFirst 3 points:\n";
    foreach (\App\Models\Point::take(3)->get() as $point) {
        echo "- {$point->name}\n";
    }
}

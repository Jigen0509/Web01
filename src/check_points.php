<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$points = \App\Models\Point::all();

echo "Points count: " . $points->count() . "\n\n";

if ($points->count() > 0) {
    echo "First 5 points:\n";
    foreach ($points->take(5) as $point) {
        echo "- ID: {$point->id}, Name: {$point->name}\n";
    }
} else {
    echo "No points found in database!\n";
}

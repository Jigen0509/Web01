<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== TESTING CONTROLLER LOGIC ===\n\n";

// コントローラーと全く同じロジック
$points = \App\Models\Point::orderBy('name')->paginate(10);

echo "Query executed: Point::orderBy('name')->paginate(10)\n";
echo "Result count: " . $points->count() . "\n";
echo "Result total: " . $points->total() . "\n";
echo "Current page: " . $points->currentPage() . "\n";
echo "Per page: " . $points->perPage() . "\n\n";

echo "=== BLADE CONDITION CHECK ===\n";
echo "isset(\$points): " . var_export(isset($points), true) . "\n";
echo "\$points->count() > 0: " . var_export($points->count() > 0, true) . "\n";
echo "Condition result: " . var_export(isset($points) && $points->count() > 0, true) . "\n\n";

echo "=== ACTUAL DATA TO BE DISPLAYED ===\n";
if (isset($points) && $points->count() > 0) {
    echo "✅ WILL DISPLAY POINTS LIST\n\n";
    foreach ($points as $point) {
        if ($point) {
            echo "  <li class=\"point-item\">\n";
            echo "    <a href=\"/points/{$point->id}\">\n";
            echo "      <span class=\"point-icon\"></span>{$point->name}\n";
            echo "    </a>\n";
            echo "  </li>\n";
        }
    }
} else {
    echo "❌ WILL DISPLAY 'NO POINTS' MESSAGE\n";
}

echo "\n=== VIEW FILE CHECK ===\n";
$viewPath = __DIR__ . '/resources/views/points/index.blade.php';
echo "View file exists: " . (file_exists($viewPath) ? "YES" : "NO") . "\n";
if (file_exists($viewPath)) {
    echo "View file size: " . filesize($viewPath) . " bytes\n";
}

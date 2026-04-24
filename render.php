<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Add mock user/session if needed, or disable auth checks
// The view uses auth(). We can mock it or let it run.
// Ensure database is ok
if (!file_exists('database/database.sqlite')) {
    touch('database/database.sqlite');
    Artisan::call('migrate:fresh --seed');
}

$html = view('welcome', ['products' => \App\Models\Product::all() ?? collect([])])->render();
file_put_contents('index.html', $html);

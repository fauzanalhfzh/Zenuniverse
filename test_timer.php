<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$u = App\Models\User::first();
// Force state: Hearts at 3, timer started exactly 5 minutes (300 seconds) ago
$u->hearts = 3;
$u->last_heart_replenished_at = now()->subSeconds(300);
$u->save();

echo "State Setup. Hearts: " . $u->hearts . ", Last Time: " . $u->last_heart_replenished_at . "\n";
echo "Simulating Request Middleware...\n";

// Fake a request to trigger middleware
$request = Illuminate\Http\Request::create('/', 'GET');
$request->setUserResolver(function () use ($u) {
    return $u;
});

$middleware = new App\Http\Middleware\RegenerateHearts();
$middleware->handle($request, function ($req) {
    return response('OK');
});

$u->refresh();
echo "State After Middleware. Hearts: " . $u->hearts . ", Last Time: " . $u->last_heart_replenished_at . "\n";


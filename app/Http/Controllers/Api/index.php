<?php

// Adjust these paths depending on where api/index.php is relative to your project root.
// If api/index.php is in the root inside an 'api' folder, vendor and bootstrap are usually up one level or in the root.
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);

<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Lambda\Components\Handlers\StreamDynamoDbHandler;

// Create the application
/** @var Illuminate\Foundation\Application $app */
$app = require_once __DIR__ . '/bootstrap/app.php';

// Bootstrap the console Kernel
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

return new StreamDynamoDbHandler;


<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use OpenApi\Generator;

$files = [
    __DIR__ . '/../../../docs/OpenApi.php',
    __DIR__ . '/../../../docs/ExercisePaths.php',
    __DIR__ . '/../../../docs/UserPaths.php',
    __DIR__ . '/../../../docs/WorkoutPaths.php',
    __DIR__ . '/../../../docs/MealPaths.php',
    __DIR__ . '/../../../docs/HydrationPaths.php',
    __DIR__ . '/../../../docs/MotivationPaths.php',
    __DIR__ . '/../../../docs/ProgressPaths.php'
];





// Load documentation classes
foreach ($files as $file) {
    require_once $file;
}

// Generate OpenAPI documentation
$openapi = (new Generator())->generate($files);

// Return JSON
header('Content-Type: application/json; charset=utf-8');

echo $openapi->toJson();

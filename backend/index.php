
<?php

require_once __DIR__ . '/vendor/autoload.php';

// =====================================
// SERVICES
// =====================================

require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/WorkoutService.php';
require_once __DIR__ . '/services/MealService.php';
require_once __DIR__ . '/services/HydrationService.php';
require_once __DIR__ . '/services/MotivationService.php';
require_once __DIR__ . '/services/ProgressService.php';
require_once __DIR__ . '/services/ExerciseService.php';

// =====================================
// REGISTER SERVICES
// =====================================

Flight::register('user_service', UserService::class);
Flight::register('workout_service', WorkoutService::class);
Flight::register('meal_service', MealService::class);
Flight::register('hydration_service', HydrationService::class);
Flight::register('motivation_service', MotivationService::class);
Flight::register('progress_service', ProgressService::class);
Flight::register('exercise_service', ExerciseService::class);

// =====================================
// ERROR HANDLER
// =====================================

Flight::map('error', function (Throwable $e) {

    $status = (int) $e->getCode();

    if ($status < 400 || $status > 599) {
        $status = 500;
    }

    Flight::response()
        ->clearBody()
        ->status($status)
        ->header('Content-Type', 'application/json; charset=utf-8')
        ->write(json_encode([
            'error' => $e->getMessage()
        ]))
        ->send();
});

// =====================================
// NOT FOUND HANDLER
// =====================================

Flight::map('notFound', function () {

    Flight::response()
        ->clearBody()
        ->status(404)
        ->header('Content-Type', 'application/json; charset=utf-8')
        ->write(json_encode([
            'error' => 'Route not found'
        ]))
        ->send();
});

// =====================================
// API ROUTES
// =====================================

require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/WorkoutRoutes.php';
require_once __DIR__ . '/routes/MealRoutes.php';
require_once __DIR__ . '/routes/HydrationRoutes.php';
require_once __DIR__ . '/routes/MotivationRoutes.php';
require_once __DIR__ . '/routes/ProgressRoutes.php';
require_once __DIR__ . '/routes/ExerciseRoutes.php';

// =====================================
// HOME
// =====================================

Flight::route('GET /', function () {

    Flight::json([
        'message' => 'Welcome to FitTrack API'
    ], 200);
});

// =====================================
// OPENAPI JSON
// =====================================

Flight::route('GET /openapi.json', function () {

    $file = __DIR__ . '/openapi.json';

    if (!is_file($file)) {
        Flight::json([
            'error' => 'OpenAPI documentation not found'
        ], 404);
        return;
    }

    $json = file_get_contents($file);
    $data = json_decode($json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        Flight::json([
            'error' => 'Invalid OpenAPI JSON',
            'details' => json_last_error_msg()
        ], 500);
        return;
    }

    Flight::json($data, 200);
});

// =====================================
// SWAGGER UI
// =====================================


Flight::route('GET /swagger', function () {
    $file = __DIR__ . '/swagger-ui/index.html';

    if (!is_file($file)) {
        Flight::json([
            'error' => 'Swagger UI file not found'
        ], 404);
        return;
    }

    Flight::response()->clearBody();
    Flight::response()->status(200);
    Flight::response()->header(
        'Content-Type',
        'text/html; charset=utf-8'
    );

    Flight::response()->write(file_get_contents($file));
});


// =====================================
// START APPLICATION
// =====================================

Flight::start();

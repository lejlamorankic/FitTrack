
<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Swagger UI
if ($path === '/public/v1/docs' ||
    $path === '/public/v1/docs/') {

    header('Content-Type: text/html; charset=utf-8');

    readfile(__DIR__ . '/public/v1/docs/index.html');

    return true;
}

// Swagger JSON
if ($path === '/public/v1/docs/swagger.php') {

    require __DIR__ . '/public/v1/docs/swagger.php';

    return true;
}

// All other requests go to FlightPHP
require __DIR__ . '/index.php';

return true;

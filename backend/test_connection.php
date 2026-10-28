<?php

require_once __DIR__ . '/config/Database.php';

try {
    $pdo = Database::connect();
    echo "SUCCESS: Connected to FitTrack database!";
} catch (Exception $e) {
    echo "ERROR: Database connection failed.";
}
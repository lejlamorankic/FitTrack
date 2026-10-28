<?php

require_once __DIR__ . '/dao/WorkoutDao.php';

try {
    $workoutDao = new WorkoutDao();

    $workouts = $workoutDao->get_all();

    echo "<h2>FitTrack - WorkoutDao Test</h2>";
    echo "<p>Number of workouts: " . count($workouts) . "</p>";

    $userWorkouts = $workoutDao->get_by_user(2);

    echo "<h3>Workouts for User ID 2</h3>";
    echo "<p>Number of workouts: " . count($userWorkouts) . "</p>";

    foreach ($userWorkouts as $workout) {
        echo "<p>";
        echo "ID: " . (int)$workout['workout_id'] . "<br>";
        echo "Name: " . htmlspecialchars($workout['name'] ?? '', ENT_QUOTES, 'UTF-8') . "<br>";
        echo "Duration: " . (int)$workout['duration'] . " minutes<br>";
        echo "Calories: " . (int)$workout['calories'] . "<br>";
        echo "Date: " . htmlspecialchars($workout['date'] ?? '', ENT_QUOTES, 'UTF-8');
        echo "</p>";
    }

} catch (Exception $e) {
    echo "ERROR: WorkoutDao test failed.";
}
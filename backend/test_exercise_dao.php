
<?php

require_once __DIR__ . '/dao/ExerciseDao.php';

try {
    $exerciseDao = new ExerciseDao();

    $exercises = $exerciseDao->get_all();

    echo "<h2>FitTrack - ExerciseDao Test</h2>";
    echo "<p>Number of exercises: " . count($exercises) . "</p>";

    $filtered = $exerciseDao->get_by_muscle_group('legs');

    echo "<h3>Exercises for muscle group: legs</h3>";
    echo "<p>Number of exercises: " . count($filtered) . "</p>";

    foreach ($filtered as $exercise) {
        echo "ID: " . (int)$exercise['exercise_id'] . "<br>";
        echo "Name: " . htmlspecialchars($exercise['name']) . "<br>";
        echo "Muscle group: " . htmlspecialchars($exercise['muscle_group']) . "<br><br>";
    }

} catch (Throwable $e) {
    echo "ExerciseDao test failed: " . htmlspecialchars($e->getMessage());
}

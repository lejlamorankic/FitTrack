
<?php

require_once __DIR__ . '/dao/ProgressDao.php';

try {
    $progressDao = new ProgressDao();

    // Get all progress entries
    $entries = $progressDao->get_all();

    echo "<h2>FitTrack - ProgressDao Test</h2>";
    echo "<p>Number of progress entries: " . count($entries) . "</p>";

    // Get progress entries for user ID 2
    $userEntries = $progressDao->get_by_user(2);

    echo "<h3>Progress for User ID 2</h3>";
    echo "<p>Number of entries: " . count($userEntries) . "</p>";

    foreach ($userEntries as $entry) {
        echo "<p>";
        echo "ID: " . (int)$entry['progress_id'] . "<br>";
        echo "Weight: " . htmlspecialchars((string)($entry['weight_kg'] ?? '')) . " kg<br>";
        echo "Notes: " . htmlspecialchars($entry['notes'] ?? '') . "<br>";
        echo "Date: " . htmlspecialchars($entry['recorded_at'] ?? '');
        echo "</p>";
    }

} catch (Throwable $e) {
    echo "ProgressDao test failed: " .
         htmlspecialchars($e->getMessage());
}


<?php

require_once __DIR__ . '/dao/MotivationDao.php';

try {
    $motivationDao = new MotivationDao();

    $entries = $motivationDao->get_all();

    echo "<h2>FitTrack - MotivationDao Test</h2>";
    echo "<p>Number of motivation entries: " . count($entries) . "</p>";

    $userEntries = $motivationDao->get_by_user(2);

    echo "<h3>Motivation for User ID 2</h3>";
    echo "<p>Number of entries: " . count($userEntries) . "</p>";

    foreach ($userEntries as $entry) {
        echo "<p>";
        echo "ID: " . (int)$entry['motivation_id'] . "<br>";
        echo "Quote: " . htmlspecialchars($entry['quote'] ?? '') . "<br>";
        echo "Date: " . htmlspecialchars($entry['date'] ?? '');
        echo "</p>";
    }

} catch (Throwable $e) {
    echo "MotivationDao test failed: " .
         htmlspecialchars($e->getMessage());
}

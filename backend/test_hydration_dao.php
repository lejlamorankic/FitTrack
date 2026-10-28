
<?php

require_once __DIR__ . '/dao/HydrationDao.php';

try {
    $hydrationDao = new HydrationDao();

    $entries = $hydrationDao->get_all();

    echo "<h2>FitTrack - HydrationDao Test</h2>";
    echo "<p>Number of entries: " . count($entries) . "</p>";

    $userEntries = $hydrationDao->get_by_user(2);

    echo "<h3>Hydration for User ID 2</h3>";
    echo "<p>Number of entries: " . count($userEntries) . "</p>";

} catch (Throwable $e) {
    echo "Test failed: " . htmlspecialchars($e->getMessage());
}

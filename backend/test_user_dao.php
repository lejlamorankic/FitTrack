<?php

require_once __DIR__ . '/dao/UserDao.php';

try {
    $userDao = new UserDao();

    $users = $userDao->get_all();

    echo "<h2>FitTrack - UserDao Test</h2>";
    echo "<p>Number of users: " . count($users) . "</p>";

    foreach ($users as $user) {
        echo "<p>";
        echo "ID: " . (int)$user['user_id'] . "<br>";
        echo "Name: " . htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') . "<br>";
        echo "Email: " . htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8');
        echo "</p>";
    }

} catch (Exception $e) {
    echo "ERROR: UserDao test failed.";
}
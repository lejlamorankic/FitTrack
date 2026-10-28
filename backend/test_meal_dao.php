<?php

require_once __DIR__ . '/dao/MealDao.php';

try {
    $mealDao = new MealDao();

    $meals = $mealDao->get_all();

    echo "<h2>FitTrack - MealDao Test</h2>";
    echo "<p>Number of meals: " . count($meals) . "</p>";

    $userMeals = $mealDao->get_by_user(2);

    echo "<h3>Meals for User ID 2</h3>";
    echo "<p>Number of meals: " . count($userMeals) . "</p>";

    foreach ($userMeals as $meal) {
        echo "<p>";
        echo "ID: " . (int)$meal['meal_id'] . "<br>";
        echo "Name: " . htmlspecialchars($meal['name'] ?? '', ENT_QUOTES, 'UTF-8') . "<br>";
        echo "Calories: " . (int)$meal['calories'] . "<br>";
        echo "Date: " . htmlspecialchars($meal['date'] ?? '', ENT_QUOTES, 'UTF-8');
        echo "</p>";
    }

} catch (Exception $e) {
    echo "ERROR: MealDao test failed.";
}

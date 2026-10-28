
<?php

require_once __DIR__ . '/dao/MealDao.php';

$mealDao = null;
$mealId = null;

try {
    $mealDao = new MealDao();

    // 1. CREATE
    $mealId = $mealDao->add([
        'user_id' => 2,
        'name' => 'CRUD Test Meal',
        'calories' => 450,
        'date' => date('Y-m-d')
    ]);

    echo "CREATE: Meal created, ID: $mealId\n";

    // 2. READ
    $meal = $mealDao->get_by_id($mealId);

    if (empty($meal)) {
        throw new Exception("READ failed.");
    }

    echo "READ: Meal found.\n";

    // 3. UPDATE
    $mealDao->update(
        [
            'name' => 'Updated CRUD Test Meal',
            'calories' => 500
        ],
        $mealId,
        'meal_id'
    );

    $updated = $mealDao->get_by_id($mealId);

    if (empty($updated) ||
        $updated['name'] !== 'Updated CRUD Test Meal' ||
        (int)$updated['calories'] !== 500) {
        throw new Exception("UPDATE failed.");
    }

    echo "UPDATE: Meal updated.\n";

    // 4. DELETE
    $mealDao->delete($mealId, 'meal_id');

    // 5. VERIFY
    $deleted = $mealDao->get_by_id($mealId);

    if (!empty($deleted)) {
        throw new Exception("DELETE failed.");
    }

    $mealId = null;

    echo "DELETE: Meal deleted.\n";
    echo "ALL CRUD TESTS PASSED!\n";

} catch (Throwable $e) {
    echo "CRUD TEST FAILED: " . $e->getMessage() . "\n";
} finally {
    // Clean up the test record if an earlier step failed.
    if ($mealDao !== null && $mealId !== null) {
        try {
            $mealDao->delete($mealId, 'meal_id');
        } catch (Throwable $cleanupError) {
            echo "Cleanup failed for meal ID $mealId\n";
        }
    }
}

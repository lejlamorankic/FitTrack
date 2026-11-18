
<?php

// GET all meals
Flight::route('GET /meals', function () {
    $meals = Flight::meal_service()->get_all();

    Flight::json($meals, 200);
});

// GET meals by user
Flight::route('GET /meals/user/@user_id:[0-9]+', function ($user_id) {
    $meals = Flight::meal_service()->get_by_user($user_id);

    Flight::json($meals, 200);
});

// GET meal by ID
Flight::route('GET /meals/@id:[0-9]+', function ($id) {
    $meal = Flight::meal_service()->get_by_id($id);

    Flight::json($meal, 200);
});

// POST create meal
Flight::route('POST /meals', function () {
    $data = Flight::request()->data->getData();

    $id = Flight::meal_service()->add($data);

    Flight::json([
        'message' => 'Meal created successfully',
        'meal_id' => $id
    ], 201);
});

// PUT update meal
Flight::route('PUT /meals/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();

    Flight::meal_service()->update($data, $id);

    Flight::json([
        'message' => 'Meal updated successfully'
    ], 200);
});

// DELETE meal
Flight::route('DELETE /meals/@id:[0-9]+', function ($id) {
    Flight::meal_service()->delete($id);

    Flight::json([
        'message' => 'Meal deleted successfully'
    ], 200);
});

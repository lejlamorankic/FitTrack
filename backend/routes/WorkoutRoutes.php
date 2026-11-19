
<?php

// GET all workouts
Flight::route('GET /workouts', function () {
    $workouts = Flight::workout_service()->get_all();

    Flight::json($workouts, 200);
});

// GET workouts by user
Flight::route('GET /workouts/user/@user_id:[0-9]+', function ($user_id) {
    $workouts = Flight::workout_service()->get_by_user($user_id);

    Flight::json($workouts, 200);
});

// GET workout by ID
Flight::route('GET /workouts/@id:[0-9]+', function ($id) {
    $workout = Flight::workout_service()->get_by_id($id);

    Flight::json($workout, 200);
});

// POST create workout
Flight::route('POST /workouts', function () {
    $data = Flight::request()->data->getData();

    $id = Flight::workout_service()->add($data);

    Flight::json([
        'message' => 'Workout created successfully',
        'workout_id' => $id
    ], 201);
});

// PUT update workout
Flight::route('PUT /workouts/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();

    Flight::workout_service()->update($data, $id);

    Flight::json([
        'message' => 'Workout updated successfully'
    ], 200);
});

// DELETE workout
Flight::route('DELETE /workouts/@id:[0-9]+', function ($id) {
    Flight::workout_service()->delete($id);

    Flight::json([
        'message' => 'Workout deleted successfully'
    ], 200);
});


<?php

// GET all exercises
Flight::route('GET /exercises', function () {
    $exercises = Flight::exercise_service()->get_all();

    Flight::json($exercises, 200);
});

// GET exercises by muscle group
Flight::route('GET /exercises/muscle/@muscle_group', function ($muscle_group) {
    $exercises = Flight::exercise_service()
        ->get_by_muscle_group($muscle_group);

    Flight::json($exercises, 200);
});

// GET exercise by ID
Flight::route('GET /exercises/@id:[0-9]+', function ($id) {
    $exercise = Flight::exercise_service()->get_by_id($id);

    Flight::json($exercise, 200);
});

// POST create exercise
Flight::route('POST /exercises', function () {
    $data = Flight::request()->data->getData();

    $id = Flight::exercise_service()->add($data);

    Flight::json([
        'message' => 'Exercise created successfully',
        'exercise_id' => $id
    ], 201);
});

// PUT update exercise
Flight::route('PUT /exercises/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();

    Flight::exercise_service()->update($data, $id);

    Flight::json([
        'message' => 'Exercise updated successfully'
    ], 200);
});

// DELETE exercise
Flight::route('DELETE /exercises/@id:[0-9]+', function ($id) {
    Flight::exercise_service()->delete($id);

    Flight::json([
        'message' => 'Exercise deleted successfully'
    ], 200);
});

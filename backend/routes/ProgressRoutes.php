
<?php

// GET all progress records
Flight::route('GET /progress', function () {
    $progress = Flight::progress_service()->get_all();

    Flight::json($progress, 200);
});

// GET progress records by user
Flight::route('GET /progress/user/@user_id:[0-9]+', function ($user_id) {
    $progress = Flight::progress_service()->get_by_user($user_id);

    Flight::json($progress, 200);
});

// GET progress record by ID
Flight::route('GET /progress/@id:[0-9]+', function ($id) {
    $progress = Flight::progress_service()->get_by_id($id);

    Flight::json($progress, 200);
});

// POST create progress record
Flight::route('POST /progress', function () {
    $data = Flight::request()->data->getData();

    $id = Flight::progress_service()->add($data);

    Flight::json([
        'message' => 'Progress record created successfully',
        'progress_id' => $id
    ], 201);
});

// PUT update progress record
Flight::route('PUT /progress/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();

    Flight::progress_service()->update($data, $id);

    Flight::json([
        'message' => 'Progress record updated successfully'
    ], 200);
});

// DELETE progress record
Flight::route('DELETE /progress/@id:[0-9]+', function ($id) {
    Flight::progress_service()->delete($id);

    Flight::json([
        'message' => 'Progress record deleted successfully'
    ], 200);
});

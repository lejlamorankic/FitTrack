
<?php

// GET all hydration records
Flight::route('GET /hydration', function () {
    $hydration = Flight::hydration_service()->get_all();

    Flight::json($hydration, 200);
});

// GET hydration records by user
Flight::route('GET /hydration/user/@user_id:[0-9]+', function ($user_id) {
    $hydration = Flight::hydration_service()->get_by_user($user_id);

    Flight::json($hydration, 200);
});

// GET hydration record by ID
Flight::route('GET /hydration/@id:[0-9]+', function ($id) {
    $hydration = Flight::hydration_service()->get_by_id($id);

    Flight::json($hydration, 200);
});

// POST create hydration record
Flight::route('POST /hydration', function () {
    $data = Flight::request()->data->getData();

    $id = Flight::hydration_service()->add($data);

    Flight::json([
        'message' => 'Hydration record created successfully',
        'hydration_id' => $id
    ], 201);
});

// PUT update hydration record
Flight::route('PUT /hydration/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();

    Flight::hydration_service()->update($data, $id);

    Flight::json([
        'message' => 'Hydration record updated successfully'
    ], 200);
});

// DELETE hydration record
Flight::route('DELETE /hydration/@id:[0-9]+', function ($id) {
    Flight::hydration_service()->delete($id);

    Flight::json([
        'message' => 'Hydration record deleted successfully'
    ], 200);
});

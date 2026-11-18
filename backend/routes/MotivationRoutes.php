
<?php

// GET all motivation records
Flight::route('GET /motivation', function () {
    $motivation = Flight::motivation_service()->get_all();

    Flight::json($motivation, 200);
});

// GET motivation records by user
Flight::route('GET /motivation/user/@user_id:[0-9]+', function ($user_id) {
    $motivation = Flight::motivation_service()->get_by_user($user_id);

    Flight::json($motivation, 200);
});

// GET motivation record by ID
Flight::route('GET /motivation/@id:[0-9]+', function ($id) {
    $motivation = Flight::motivation_service()->get_by_id($id);

    Flight::json($motivation, 200);
});

// POST create motivation record
Flight::route('POST /motivation', function () {
    $data = Flight::request()->data->getData();

    $id = Flight::motivation_service()->add($data);

    Flight::json([
        'message' => 'Motivation record created successfully',
        'motivation_id' => $id
    ], 201);
});

// PUT update motivation record
Flight::route('PUT /motivation/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();

    Flight::motivation_service()->update($data, $id);

    Flight::json([
        'message' => 'Motivation record updated successfully'
    ], 200);
});

// DELETE motivation record
Flight::route('DELETE /motivation/@id:[0-9]+', function ($id) {
    Flight::motivation_service()->delete($id);

    Flight::json([
        'message' => 'Motivation record deleted successfully'
    ], 200);
});


 // GET random motivational quote from external API
Flight::route('GET /motivation/random', function () {
    $quote = Flight::motivation_service()->get_random_quote();

    Flight::json($quote, 200);
});


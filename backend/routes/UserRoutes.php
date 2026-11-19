
<?php

// GET all users
Flight::route('GET /users', function () {
    $users = Flight::user_service()->get_all();
    Flight::json($users, 200);
});

// GET user by ID
Flight::route('GET /users/@id:[0-9]+', function ($id) {
    $user = Flight::user_service()->get_by_id($id);
    Flight::json($user, 200);
});

// POST create user
Flight::route('POST /users', function () {
    $data = Flight::request()->data->getData();

    $id = Flight::user_service()->add($data);

    Flight::json([
        'message' => 'User created successfully',
        'user_id' => $id
    ], 201);
});

// PUT update user
Flight::route('PUT /users/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();

    Flight::user_service()->update($data, $id);

    Flight::json([
        'message' => 'User updated successfully'
    ], 200);
});

// DELETE user
Flight::route('DELETE /users/@id:[0-9]+', function ($id) {
    Flight::user_service()->delete($id);

    Flight::json([
        'message' => 'User deleted successfully'
    ], 200);
});

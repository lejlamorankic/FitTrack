
<?php

use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Users',
    description: 'User management endpoints'
)]
class UserPaths
{
    #[OA\Get(
        path: '/users',
        summary: 'Get all users',
        tags: ['Users'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of all users',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(type: 'object')
                )
            )
        ]
    )]
    public function getAllUsers() {}

    #[OA\Get(
        path: '/users/{id}',
        summary: 'Get user by ID',
        tags: ['Users'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'User found'
            ),
            new OA\Response(
                response: 404,
                description: 'User not found'
            )
        ]
    )]
    public function getUserById() {}

    #[OA\Post(
        path: '/users',
        summary: 'Create a new user',
        tags: ['Users'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                type: 'object',
                additionalProperties: true
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'User created successfully'
            ),
            new OA\Response(
                response: 400,
                description: 'Invalid user data'
            )
        ]
    )]
    public function createUser() {}

    #[OA\Put(
        path: '/users/{id}',
        summary: 'Update an existing user',
        tags: ['Users'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                type: 'object',
                additionalProperties: true
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'User updated successfully'
            ),
            new OA\Response(
                response: 400,
                description: 'Invalid user data'
            ),
            new OA\Response(
                response: 404,
                description: 'User not found'
            )
        ]
    )]
    public function updateUser() {}

    #[OA\Delete(
        path: '/users/{id}',
        summary: 'Delete a user',
        tags: ['Users'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'User deleted successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'User not found'
            )
        ]
    )]
    public function deleteUser() {}
}

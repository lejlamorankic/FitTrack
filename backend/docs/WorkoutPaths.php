
<?php

use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Workouts',
    description: 'Workout management endpoints'
)]
class WorkoutPaths
{
    // GET all workouts
    #[OA\Get(
        path: '/workouts',
        summary: 'Get all workouts',
        tags: ['Workouts'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of all workouts',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(type: 'object')
                )
            )
        ]
    )]
    public function getAllWorkouts() {}

    // GET workouts by user
    #[OA\Get(
        path: '/workouts/user/{user_id}',
        summary: 'Get workouts by user ID',
        tags: ['Workouts'],
        parameters: [
            new OA\Parameter(
                name: 'user_id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of workouts for the specified user',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(type: 'object')
                )
            )
        ]
    )]
    public function getWorkoutsByUser() {}

    // GET workout by ID
    #[OA\Get(
        path: '/workouts/{id}',
        summary: 'Get workout by ID',
        tags: ['Workouts'],
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
                description: 'Workout found'
            ),
            new OA\Response(
                response: 404,
                description: 'Workout not found'
            )
        ]
    )]
    public function getWorkoutById() {}

    // POST create workout
    #[OA\Post(
        path: '/workouts',
        summary: 'Create a new workout',
        tags: ['Workouts'],
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
                description: 'Workout created successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Workout created successfully'
                        ),
                        new OA\Property(
                            property: 'workout_id',
                            type: 'integer',
                            example: 1
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: 'Invalid workout data'
            )
        ]
    )]
    public function createWorkout() {}

    // PUT update workout
    #[OA\Put(
        path: '/workouts/{id}',
        summary: 'Update an existing workout',
        tags: ['Workouts'],
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
                description: 'Workout updated successfully'
            ),
            new OA\Response(
                response: 400,
                description: 'Invalid workout data'
            ),
            new OA\Response(
                response: 404,
                description: 'Workout not found'
            )
        ]
    )]
    public function updateWorkout() {}

    // DELETE workout
    #[OA\Delete(
        path: '/workouts/{id}',
        summary: 'Delete a workout',
        tags: ['Workouts'],
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
                description: 'Workout deleted successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Workout not found'
            )
        ]
    )]
    public function deleteWorkout() {}
}

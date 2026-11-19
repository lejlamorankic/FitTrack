
<?php

use OpenApi\Attributes as OA;

class ExercisePaths
{
    // GET ALL EXERCISES
    #[OA\Get(
        path: "/exercises",
        summary: "Get all exercises",
        tags: ["Exercises"],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of all exercises",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "exercise_id",
                                type: "integer",
                                example: 1
                            ),
                            new OA\Property(
                                property: "name",
                                type: "string",
                                example: "Squats"
                            ),
                            new OA\Property(
                                property: "muscle_group",
                                type: "string",
                                example: "legs"
                            ),
                            new OA\Property(
                                property: "difficulty",
                                type: "string",
                                example: "beginner"
                            )
                        ]
                    )
                )
            ),
            new OA\Response(
                response: 500,
                description: "Internal server error"
            )
        ]
    )]
    public function getAll(): void
    {
    }

    // GET EXERCISES BY MUSCLE GROUP
    #[OA\Get(
        path: "/exercises/muscle/{muscle_group}",
        summary: "Get exercises by muscle group",
        tags: ["Exercises"],
        parameters: [
            new OA\Parameter(
                name: "muscle_group",
                in: "path",
                required: true,
                description: "Muscle group",
                schema: new OA\Schema(
                    type: "string",
                    example: "legs"
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Exercises retrieved successfully",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        type: "object"
                    )
                )
            ),
            new OA\Response(
                response: 400,
                description: "Invalid muscle group"
            ),
            new OA\Response(
                response: 500,
                description: "Internal server error"
            )
        ]
    )]
    public function getByMuscleGroup(): void
    {
    }

    // GET EXERCISE BY ID
    #[OA\Get(
        path: "/exercises/{id}",
        summary: "Get exercise by ID",
        tags: ["Exercises"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Exercise ID",
                schema: new OA\Schema(
                    type: "integer",
                    minimum: 1,
                    example: 1
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Exercise found",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "exercise_id",
                            type: "integer",
                            example: 1
                        ),
                        new OA\Property(
                            property: "name",
                            type: "string",
                            example: "Squats"
                        ),
                        new OA\Property(
                            property: "muscle_group",
                            type: "string",
                            example: "legs"
                        ),
                        new OA\Property(
                            property: "difficulty",
                            type: "string",
                            example: "beginner"
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: "Exercise not found"
            ),
            new OA\Response(
                response: 500,
                description: "Internal server error"
            )
        ]
    )]
    public function getById(): void
    {
    }

    // POST CREATE EXERCISE
    #[OA\Post(
        path: "/exercises",
        summary: "Create a new exercise",
        tags: ["Exercises"],
        requestBody: new OA\RequestBody(
            required: true,
            description: "Exercise data",
            content: new OA\JsonContent(
                required: [
                    "name",
                    "muscle_group",
                    "difficulty"
                ],
                properties: [
                    new OA\Property(
                        property: "name",
                        type: "string",
                        example: "Squats"
                    ),
                    new OA\Property(
                        property: "muscle_group",
                        type: "string",
                        example: "legs"
                    ),
                    new OA\Property(
                        property: "difficulty",
                        type: "string",
                        enum: [
                            "beginner",
                            "intermediate",
                            "advanced"
                        ],
                        example: "beginner"
                    )
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Exercise created successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "message",
                            type: "string",
                            example: "Exercise created successfully"
                        ),
                        new OA\Property(
                            property: "exercise_id",
                            type: "integer",
                            example: 12
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Invalid exercise data"
            ),
            new OA\Response(
                response: 500,
                description: "Internal server error"
            )
        ]
    )]
    public function createExercise(): void
    {
    }

    // PUT UPDATE EXERCISE
    #[OA\Put(
        path: "/exercises/{id}",
        summary: "Update an existing exercise",
        tags: ["Exercises"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Exercise ID",
                schema: new OA\Schema(
                    type: "integer",
                    minimum: 1,
                    example: 1
                )
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: "Fields to update",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "name",
                        type: "string",
                        example: "Updated Squats"
                    ),
                    new OA\Property(
                        property: "muscle_group",
                        type: "string",
                        example: "legs"
                    ),
                    new OA\Property(
                        property: "difficulty",
                        type: "string",
                        enum: [
                            "beginner",
                            "intermediate",
                            "advanced"
                        ],
                        example: "intermediate"
                    )
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Exercise updated successfully"
            ),
            new OA\Response(
                response: 400,
                description: "Invalid exercise data"
            ),
            new OA\Response(
                response: 404,
                description: "Exercise not found"
            ),
            new OA\Response(
                response: 500,
                description: "Internal server error"
            )
        ]
    )]
    public function updateExercise(): void
    {
    }

    // DELETE EXERCISE
    #[OA\Delete(
        path: "/exercises/{id}",
        summary: "Delete an exercise",
        tags: ["Exercises"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Exercise ID",
                schema: new OA\Schema(
                    type: "integer",
                    minimum: 1,
                    example: 1
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Exercise deleted successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "message",
                            type: "string",
                            example: "Exercise deleted successfully"
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: "Exercise not found"
            ),
            new OA\Response(
                response: 500,
                description: "Internal server error"
            )
        ]
    )]
    public function deleteExercise(): void
    {
    }
}

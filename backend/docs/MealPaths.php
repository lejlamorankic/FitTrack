
<?php

use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Meals',
    description: 'Meal management endpoints'
)]
class MealPaths
{
    // GET all meals
    #[OA\Get(
        path: '/meals',
        summary: 'Get all meals',
        tags: ['Meals'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of all meals',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(type: 'object')
                )
            )
        ]
    )]
    public function getAllMeals() {}

    // GET meals by user
    #[OA\Get(
        path: '/meals/user/{user_id}',
        summary: 'Get meals by user ID',
        tags: ['Meals'],
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
                description: 'List of meals for the specified user',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(type: 'object')
                )
            )
        ]
    )]
    public function getMealsByUser() {}

    // GET meal by ID
    #[OA\Get(
        path: '/meals/{id}',
        summary: 'Get meal by ID',
        tags: ['Meals'],
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
                description: 'Meal found'
            ),
            new OA\Response(
                response: 404,
                description: 'Meal not found'
            )
        ]
    )]
    public function getMealById() {}

    // POST create meal
    #[OA\Post(
        path: '/meals',
        summary: 'Create a new meal',
        tags: ['Meals'],
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
                description: 'Meal created successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Meal created successfully'
                        ),
                        new OA\Property(
                            property: 'meal_id',
                            type: 'integer',
                            example: 1
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: 'Invalid meal data'
            )
        ]
    )]
    public function createMeal() {}

    // PUT update meal
    #[OA\Put(
        path: '/meals/{id}',
        summary: 'Update an existing meal',
        tags: ['Meals'],
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
                description: 'Meal updated successfully'
            ),
            new OA\Response(
                response: 400,
                description: 'Invalid meal data'
            ),
            new OA\Response(
                response: 404,
                description: 'Meal not found'
            )
        ]
    )]
    public function updateMeal() {}

    // DELETE meal
    #[OA\Delete(
        path: '/meals/{id}',
        summary: 'Delete a meal',
        tags: ['Meals'],
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
                description: 'Meal deleted successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Meal not found'
            )
        ]
    )]
    public function deleteMeal() {}
}

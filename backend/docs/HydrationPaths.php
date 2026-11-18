
<?php

use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Hydration',
    description: 'Hydration tracking and management endpoints'
)]
class HydrationPaths
{
    // GET all hydration records
    #[OA\Get(
        path: '/hydration',
        summary: 'Get all hydration records',
        tags: ['Hydration'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of all hydration records',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(type: 'object')
                )
            )
        ]
    )]
    public function getAllHydration() {}

    // GET hydration records by user
    #[OA\Get(
        path: '/hydration/user/{user_id}',
        summary: 'Get hydration records by user ID',
        tags: ['Hydration'],
        parameters: [
            new OA\Parameter(
                name: 'user_id',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 1
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Hydration records for the specified user',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(type: 'object')
                )
            )
        ]
    )]
    public function getHydrationByUser() {}

    // GET hydration record by ID
    #[OA\Get(
        path: '/hydration/{id}',
        summary: 'Get hydration record by ID',
        tags: ['Hydration'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 1
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Hydration record found'
            ),
            new OA\Response(
                response: 404,
                description: 'Hydration record not found'
            )
        ]
    )]
    public function getHydrationById() {}

    // POST create hydration record
    #[OA\Post(
        path: '/hydration',
        summary: 'Create a hydration record',
        tags: ['Hydration'],
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
                description: 'Hydration record created successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Hydration record created successfully'
                        ),
                        new OA\Property(
                            property: 'hydration_id',
                            type: 'integer',
                            example: 1
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: 'Invalid hydration data'
            )
        ]
    )]
    public function createHydration() {}

    // PUT update hydration record
    #[OA\Put(
        path: '/hydration/{id}',
        summary: 'Update a hydration record',
        tags: ['Hydration'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 1
                )
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
                description: 'Hydration record updated successfully'
            ),
            new OA\Response(
                response: 400,
                description: 'Invalid hydration data'
            ),
            new OA\Response(
                response: 404,
                description: 'Hydration record not found'
            )
        ]
    )]
    public function updateHydration() {}

    // DELETE hydration record
    #[OA\Delete(
        path: '/hydration/{id}',
        summary: 'Delete a hydration record',
        tags: ['Hydration'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 1
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Hydration record deleted successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Hydration record deleted successfully'
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Hydration record not found'
            )
        ]
    )]
    public function deleteHydration() {}
}

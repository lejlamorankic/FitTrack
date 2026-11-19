
<?php

use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Motivation',
    description: 'Motivation tracking and management endpoints'
)]
class MotivationPaths
{
    // GET all motivation records
    #[OA\Get(
        path: '/motivation',
        summary: 'Get all motivation records',
        tags: ['Motivation'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of all motivation records',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(type: 'object')
                )
            )
        ]
    )]
    public function getAllMotivation() {}

    // GET motivation records by user
    #[OA\Get(
        path: '/motivation/user/{user_id}',
        summary: 'Get motivation records by user ID',
        tags: ['Motivation'],
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
                description: 'Motivation records for the specified user',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(type: 'object')
                )
            )
        ]
    )]
    public function getMotivationByUser() {}

    // GET motivation record by ID
    #[OA\Get(
        path: '/motivation/{id}',
        summary: 'Get motivation record by ID',
        tags: ['Motivation'],
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
                description: 'Motivation record found'
            ),
            new OA\Response(
                response: 404,
                description: 'Motivation record not found'
            )
        ]
    )]
    public function getMotivationById() {}

    // POST create motivation record
    #[OA\Post(
        path: '/motivation',
        summary: 'Create a motivation record',
        tags: ['Motivation'],
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
                description: 'Motivation record created successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Motivation record created successfully'
                        ),
                        new OA\Property(
                            property: 'motivation_id',
                            type: 'integer',
                            example: 1
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: 'Invalid motivation data'
            )
        ]
    )]
    public function createMotivation() {}

    // PUT update motivation record
    #[OA\Put(
        path: '/motivation/{id}',
        summary: 'Update a motivation record',
        tags: ['Motivation'],
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
                description: 'Motivation record updated successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Motivation record updated successfully'
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: 'Invalid motivation data'
            ),
            new OA\Response(
                response: 404,
                description: 'Motivation record not found'
            )
        ]
    )]
    public function updateMotivation() {}

    // DELETE motivation record
    #[OA\Delete(
        path: '/motivation/{id}',
        summary: 'Delete a motivation record',
        tags: ['Motivation'],
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
                description: 'Motivation record deleted successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Motivation record deleted successfully'
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Motivation record not found'
            )
        ]
    )]
    public function deleteMotivation() {}


    // GET random motivational quote from external API
    #[OA\Get(
        path: '/motivation/random',
        summary: 'Get random motivational quote',
        description: 'Fetches a random motivational quote from an external API (ZenQuotes).',
        tags: ['Motivation'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Random motivational quote retrieved successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'quote',
                            type: 'string',
                            example: 'Believe you can and you are halfway there.'
                        ),
                        new OA\Property(
                            property: 'author',
                            type: 'string',
                            example: 'Theodore Roosevelt'
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 502,
                description: 'Invalid response from external API'
            ),
            new OA\Response(
                response: 503,
                description: 'External API unavailable'
            )
        ]
    )]
    public function getRandomQuote() {}

}

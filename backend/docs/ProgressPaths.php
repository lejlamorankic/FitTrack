
<?php

use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Progress',
    description: 'Progress tracking and management endpoints'
)]
class ProgressPaths
{
    // GET all progress records
    #[OA\Get(
        path: '/progress',
        summary: 'Get all progress records',
        tags: ['Progress'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of all progress records',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(type: 'object')
                )
            )
        ]
    )]
    public function getAllProgress() {}

    // GET progress records by user
    #[OA\Get(
        path: '/progress/user/{user_id}',
        summary: 'Get progress records by user ID',
        tags: ['Progress'],
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
                description: 'Progress records for the specified user',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(type: 'object')
                )
            )
        ]
    )]
    public function getProgressByUser() {}

    // GET progress record by ID
    #[OA\Get(
        path: '/progress/{id}',
        summary: 'Get progress record by ID',
        tags: ['Progress'],
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
                description: 'Progress record found',
                content: new OA\JsonContent(
                    type: 'object',
                    additionalProperties: true
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Progress record not found'
            )
        ]
    )]
    public function getProgressById() {}

    // POST create progress record
    #[OA\Post(
        path: '/progress',
        summary: 'Create a progress record',
        tags: ['Progress'],
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
                description: 'Progress record created successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Progress record created successfully'
                        ),
                        new OA\Property(
                            property: 'progress_id',
                            type: 'integer',
                            example: 1
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: 'Invalid progress data'
            )
        ]
    )]
    public function createProgress() {}

    // PUT update progress record
    #[OA\Put(
        path: '/progress/{id}',
        summary: 'Update a progress record',
        tags: ['Progress'],
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
                description: 'Progress record updated successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Progress record updated successfully'
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: 'Invalid progress data'
            ),
            new OA\Response(
                response: 404,
                description: 'Progress record not found'
            )
        ]
    )]
    public function updateProgress() {}

    // DELETE progress record
    #[OA\Delete(
        path: '/progress/{id}',
        summary: 'Delete a progress record',
        tags: ['Progress'],
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
                description: 'Progress record deleted successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Progress record deleted successfully'
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Progress record not found'
            )
        ]
    )]
    public function deleteProgress() {}
}

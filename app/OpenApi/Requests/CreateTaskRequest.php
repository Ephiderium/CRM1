<?php

namespace App\OpenApi\Requests;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: "CreateTaskRequest",
    required: true,
    content: new OA\JsonContent(
        required: ['title', 'description', 'assigned_to', 'related_type', 'related_id', 'due_date', 'status'],
        properties: [
            new OA\Property(
                property: "title",
                type: "string",
                example: "test title",
            ),
            new OA\Property(
                property: "description",
                type: "string",
                example: "test description",
            ),
            new OA\Property(
                property: "assigned_to",
                type: "integer",
                example: "1",
                description: "Id юзера"
            ),
            new OA\Property(
                property: "related_type",
                type: "string",
                example: "client",
                description: "Из списка: client, deal"
            ),
            new OA\Property(
                property: "due_date",
                type: "string",
                example: "2026-02-01 21-22",
                description: "Deadline"
            ),
            new OA\Property(
                property: "status",
                type: "string",
                example: "new",
                description: "Из списка: new, progress, done, overdue"
            ),
        ]
    )
)]

class CreateTaskRequest {}

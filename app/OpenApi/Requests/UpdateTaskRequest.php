<?php

namespace App\OpenApi\Requests;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: "UpdateTaskRequest",
    required: true,
    content: new OA\JsonContent(
        required: [],
        properties: [
            new OA\Property(
                property: "title",
                type: "string",
                nullable: true,
                example: "test title",
            ),
            new OA\Property(
                property: "description",
                type: "string",
                nullable: true,
                example: "test description",
            ),
            new OA\Property(
                property: "assigned_to",
                type: "integer",
                nullable: true,
                example: "1",
                description: "Id юзера"
            ),
            new OA\Property(
                property: "related_type",
                type: "string",
                nullable: true,
                example: "client",
                description: "Из списка: client, deal"
            ),
            new OA\Property(
                property: "due_date",
                type: "string",
                nullable: true,
                example: "2026-02-01 21-22",
                description: "Deadline"
            ),
            new OA\Property(
                property: "status",
                type: "string",
                nullable: true,
                example: "new",
                description: "Из списка: new, progress, done, overdue"
            ),
        ]
    )
)]

class UpdateTaskRequest {}

<?php

namespace App\OpenApi\Requests;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: "UpdateUserRequest",
    required: true,
    content: new OA\JsonContent(
        required: [],
        properties: [
            new OA\Property(
                property: "name",
                nullable: true,
                type: "string",
                example: "Adam",
            ),
            new OA\Property(
                property: "email",
                nullable: true,
                type: "string",
                format: "email",
                example: "t@test.com",
            ),
            new OA\Property(
                property: "password",
                nullable: true,
                type: "string",
                example: "test00000",
                description: "Minimum 8 symbols"
            ),
            new OA\Property(
                property: "is_active",
                nullable: true,
                type: "boolean",
                example: "true",
            ),
            new OA\Property(
                property: "role",
                nullable: true,
                type: "string",
                example: "user",
                description: "Из списка: admin, manager, user, viewer",
            ),
        ]
    )
)]

class UpdateUserRequest {}

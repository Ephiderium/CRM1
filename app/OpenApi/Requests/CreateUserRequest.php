<?php

namespace App\OpenApi\Requests;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: "CreateUserRequest",
    required: true,
    content: new OA\JsonContent(
        required: ['name', 'email', 'password', 'is_active', 'role'],
        properties: [
            new OA\Property(
                property: "name",
                type: "string",
                example: "Adam",
            ),
            new OA\Property(
                property: "email",
                type: "string",
                format: "email",
                example: "t@test.com",
            ),
            new OA\Property(
                property: "password",
                type: "string",
                example: "test00000",
                description: "Minimum 8 symbols"
            ),
            new OA\Property(
                property: "is_active",
                type: "boolean",
                example: "true",
            ),
            new OA\Property(
                property: "role",
                type: "string",
                example: "user",
                description: "Из списка: admin, manager, user, viewer",
            ),
        ]
    )
)]

class CreateUserRequest {}

<?php

namespace App\OpenApi\Requests;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: "LoginRequest",
    required: true,
    content: new OA\JsonContent(
        required: ['email', 'password'],
        properties: [
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
        ]
    )
)]

class LoginRequest {}

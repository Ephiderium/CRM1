<?php

namespace App\OpenApi\Requests;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: "ResetPasswordRequest",
    required: true,
    content: new OA\JsonContent(
        required: ['current_password', 'new_password'],
        properties: [
            new OA\Property(
                property: "current_password",
                type: "string",
                example: "test11111",
                description: "Minimum 8 symbols"
            ),
            new OA\Property(
                property: "new_password",
                type: "string",
                example: "test00000",
                description: "Minimum 8 symbols"
            ),
        ]
    )
)]

class ResetPasswordRequest {}

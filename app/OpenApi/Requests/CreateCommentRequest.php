<?php

namespace App\OpenApi\Requests;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: "CreateCommentRequest",
    required: true,
    content: new OA\JsonContent(
        required: ['user_id', 'body'],
        properties: [
            new OA\Property(
                property: "user_id",
                type: "integer",
                example: "1",
            ),
            new OA\Property(
                property: "body",
                type: "string",
                example: "example body comment",
            ),
        ]
    )
)]

class CreateCommentRequest {}

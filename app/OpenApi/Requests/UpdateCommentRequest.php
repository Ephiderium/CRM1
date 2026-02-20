<?php

namespace App\OpenApi\Requests;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: "UpdateCommentRequest",
    required: true,
    content: new OA\JsonContent(
        required: [],
        properties: [
            new OA\Property(
                property: "user_id",
                type: "integer",
                nullable: true,
                example: "1",
            ),
            new OA\Property(
                property: "body",
                type: "string",
                nullable: true,
                example: "example body comment",
            ),
        ]
    )
)]

class UpdateCommentRequest {}

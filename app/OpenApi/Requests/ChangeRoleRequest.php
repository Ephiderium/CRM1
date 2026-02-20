<?php

namespace App\OpenApi\Requests;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: "ChangeRoleRequest",
    required: true,
    content: new OA\JsonContent(
        required: ["email", "role"],
        properties: [
            new OA\Property(
                property: "email",
                type: "string",
                format: "email",
                example: "user@example.com",
                description: "email для поиска user"
                ),
            new OA\Property(
                property: "role",
                type: "string",
                example: "manager",
                description: "Доступрые роли: admin, manager, user, viewer"
                ),
        ]
    )
)]

class ChangeRoleRequest {}

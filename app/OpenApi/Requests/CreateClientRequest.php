<?php

namespace App\OpenApi\Requests;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: "CreateClientRequest",
    required: true,
    content: new OA\JsonContent(
        required: ['name', 'emai', 'phone', 'company', 'source', 'manager_id', 'status'],
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
                example: "t@test.com"
                ),
            new OA\Property(
                property: "phone",
                type: "string",
                example: "+1998573422",
                ),
            new OA\Property(
                property: "company",
                type: "string",
                example: "test.co",
            ),
            new OA\Property(
                property: "source",
                type: "string",
                example: "call",
                description: "Из списка: advertising, call, site",
            ),
            new OA\Property(
                property: "manager_id",
                type: "integer",
                example: 1,
            ),
            new OA\Property(
                property: "status",
                type: "string",
                example: "new",
                description: "Из списка: new, active, archived",
            ),
        ]
    )
)]

class CreateClientRequest {}

<?php

namespace App\OpenApi\Requests;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: "ClientFilterRequest",
    required: false,
    content: new OA\JsonContent(
        required: [],
        properties: [
            new OA\Property(
                property: "name",
                type: "string",
                nullable: true,
                example: "Adam",
            ),
            new OA\Property(
                property: "email",
                type: "string",
                format: "email",
                nullable: true,
                example: "t@test.com"
                ),
            new OA\Property(
                property: "phone",
                type: "string",
                nullable: true,
                example: "+1998573422",
                ),
            new OA\Property(
                property: "company",
                type: "string",
                nullable: true,
                example: "test.co",
            ),
            new OA\Property(
                property: "source",
                type: "string",
                nullable: true,
                description: "Из списка: advertising, call, site",
            ),
            new OA\Property(
                property: "manager_id",
                type: "integer",
                nullable: true,
            ),
            new OA\Property(
                property: "status",
                type: "string",
                nullable: true,
                description: "Из списка: new, active, archived",
            ),
        ]
    )
)]

class ClientFilterRequest {}

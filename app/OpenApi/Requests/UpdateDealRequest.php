<?php

namespace App\OpenApi\Requests;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: "UpdateDealRequest",
    required: true,
    content: new OA\JsonContent(
        required: [],
        properties: [
            new OA\Property(
                property: "client_id",
                nullable: true,
                type: "integer",
                example: "1",
            ),
            new OA\Property(
                property: "manager_id",
                nullable: true,
                type: "integer",
                example: "1",
            ),
            new OA\Property(
                property: "amount",
                type: "integer",
                nullable: true,
                example: "10000",
            ),
            new OA\Property(
                property: "stage",
                type: "string",
                nullable: true,
                example: "new",
                description: "Из списка: new, progress, won, lost"
            ),
            new OA\Property(
                property: "expected_close_date",
                type: "string",
                nullable: true,
                example: "2024-01-20",
            ),
        ]
    )
)]

class UpdateDealRequest {}

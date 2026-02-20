<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Deal",
    required: ["amount", "stage", "expected_close_date"]
)]
class DealSchema {
    #[OA\Property(type: "integer", example: 11222)]
    public string $amount;

    #[OA\Property(type: "string", example: "new")]
    public string $stage;

    #[OA\Property(type: "string", example: "2025-01-20")]
    public string $expected_close_date;
}

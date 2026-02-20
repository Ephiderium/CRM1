<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "User",
    required: ["name", "email", "is_active"]
)]
class UserSchema {
    #[OA\Property(type: "string", example: "Adam")]
    public string $name;

    #[OA\Property(type: "string", format: "email", example: "t@test.com")]
    public string $email;

    #[OA\Property(type: "boolean", example: true)]
    public string $is_active;
}

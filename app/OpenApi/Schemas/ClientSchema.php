<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Client",
    required: ["name", "email", "phone", "company", "source", "status"]
)]
class ClientSchema {
    #[OA\Property(type: "string", example: "Adam")]
    public string $name;

    #[OA\Property(type: "string", format: "email", example: "t@test.com")]
    public string $email;

    #[OA\Property(type: "string", example: "+1235464333")]
    public string $phone;

    #[OA\Property(type: "string", example: "test.co")]
    public string $company;

    #[OA\Property(type: "string", example: "call")]
    public string $source;

    #[OA\Property(type: "string", example: "new")]
    public string $status;
}

<?php

namespace App\OpenApi\Security;

use OpenApi\Attributes as OA;

#[OA\SecurityScheme(
    securityScheme: "sanctum",
    type: "http",
    scheme: "bearer",
    bearerFormat: "Token"
)]
class BearerAuth {}

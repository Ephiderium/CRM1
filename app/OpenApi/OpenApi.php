<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\OpenApi(
    info: new OA\Info(
        title: "CRM1 API",
        version: "1.0.0"
    )
)]
class OpenApi{}

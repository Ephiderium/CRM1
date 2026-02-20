<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Comment",
    required: ["body"]
)]
class CommentSchema {
    #[OA\Property(type: "string", example: "test body comment")]
    public string $body;
}

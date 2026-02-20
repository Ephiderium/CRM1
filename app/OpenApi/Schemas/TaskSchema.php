<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Task",
    required: ["title", "description", "deadline", "status"]
)]
class TaskSchema {
    #[OA\Property(type: "string", example: "test title")]
    public string $title;

    #[OA\Property(type: "string", example: "test description")]
    public string $description;

    #[OA\Property(type: "string", example: "2026-02-01")]
    public string $deadline;

    #[OA\Property(type: "string", example: "new")]
    public string $status;
}

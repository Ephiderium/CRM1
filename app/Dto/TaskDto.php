<?php

namespace App\Dto;

use App\Models\Task;

class TaskDto
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public int $assigned_to,
        public string $related_type,
        public int $related_id,
        public string $due_date,
        public string $status,
    ) {}

    public static function fromModel(Task $model): self
    {
        return new self(
            id: $model->id,
            title: $model->title,
            description: $model->description,
            assigned_to: $model->assigned_to,
            related_type: $model->related_type,
            related_id: $model->related_id,
            due_date: $model->due_date,
            status: $model->status
        );
    }
}

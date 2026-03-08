<?php

namespace App\Dto;

use App\Models\Comment;

class CommentDto
{
    public function __construct(
        public int $id,
        public int $user_id,
        public string $commentable_type,
        public int $commentable_id,
        public string $body,
    ) {}

    public static function fromModel(Comment $model): self
    {
        return new self(
            id: $model->id,
            user_id: $model->user_id,
            commentable_type: $model->commentable_type,
            commentable_id: $model->commentable_id,
            body: $model->body,
        );
    }
}

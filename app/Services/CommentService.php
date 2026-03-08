<?php

namespace App\Services;

use App\Dto\CommentDto;
use App\Observers\AuditObserver;
use App\Repository\Eloquent\Interfaces\ClientRepositoryInterface;
use App\Repository\Eloquent\Interfaces\CommentRepositoryInterface;
use App\Repository\Eloquent\Interfaces\DealRepositoryInterface;

class CommentService
{
    public function __construct(
        protected CommentRepositoryInterface $comments,
        protected DealRepositoryInterface $deals,
        protected ClientRepositoryInterface $clients,
    ) {}

    public function index(): array
    {
        return $this->comments->index();
    }

    public function findById(int $id): CommentDto
    {
        return $this->comments->findById($id);
    }

    public function findByUser(int $id): array
    {
        return $this->comments->findByUser($id);
    }

    public function create(int $id, string $instance, array $data): ?CommentDto
    {
        $model = match($instance) {
            'deal' => $this->deals->createComment($id, $data),
            'client' => $this->clients->createComment($id, $data),
        };

        return $model;
    }

    public function update(int $id, array $data): bool|CommentDto
    {
        if(!$this->comments->findById($id)) {
            return false;
        }

        $model = $this->comments->update($id, $data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->comments->findById($id);

        if(!$model) {
            return false;
        }

        return $this->comments->delete($id);
    }
}

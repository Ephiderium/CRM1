<?php

namespace App\Services;

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
        protected AuditObserver $obs,
    ) {}

    public function index()
    {
        return $this->comments->index();
    }

    public function findById(int $id)
    {
        return $this->comments->findById($id);
    }

    public function findByUser(int $id)
    {
        return $this->comments->findByUser($id);
    }

    public function create(int $id, string $instance, array $data)
    {
        $model = match($instance) {
            'deal' => $this->deals->createComment($id, $data),
            'client' => $this->clients->createComment($id, $data),
        };

        $this->obs->create($model);

        return $model;
    }

    public function update(int $id, array $data)
    {
        if(!$this->comments->findById($id)) {
            return false;
        }

        $model = $this->comments->update($id, $data);
        $this->obs->update($model);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->comments->findById($id);

        if(!$model) {
            return false;
        }

        $this->obs->delete($model);

        return $this->comments->delete($id);
    }
}

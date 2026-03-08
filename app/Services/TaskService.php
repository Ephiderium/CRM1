<?php

namespace App\Services;

use App\Dto\TaskDto;
use App\Events\ChangeAssigned;
use App\Events\TaskStatus;
use App\Observers\AuditObserver;
use App\Repository\Eloquent\Interfaces\ClientRepositoryInterface;
use App\Repository\Eloquent\Interfaces\DealRepositoryInterface;
use App\Repository\Eloquent\Interfaces\TaskRepositoryInterface;
use PhpParser\Node\Expr\Cast\Array_;

class TaskService
{
    public function __construct(
        protected TaskRepositoryInterface $task,
        protected ClientRepositoryInterface $clients,
        protected DealRepositoryInterface $deals,
    ) {}

    public function index(): array
    {
        return $this->task->index();
    }

    public function findById(int $id): TaskDto
    {
        return $this->task->findById($id);
    }

    public function findByUser(int $id): TaskDto
    {
        return $this->task->findById($id);
    }

    public function create(array $data): TaskDto
    {
        $model = $this->task->create($data);
        event(new ChangeAssigned(
                task_id: $model->id,
                oldValue: ['oldValue' => $model->assigned_to],
                newValue: ['newValue' => $data['assigned_to']],
            ));

        return $model;
    }

    public function update(int $id, array $data): ?TaskDto
    {
        if (!$this->task->findById($id)) {
            return null;
        }

        $model = $this->task->update($id, $data);

        if (isset($data['assigned_to'])) {
            event(new ChangeAssigned(
                task_id: $id,
                oldValue: ['oldValue' => $model->assigned_to],
                newValue: ['newValue' => $data['assigned_to']],
            ));
        }

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->findById($id);

        if (!$model) {
            return false;
        }

        return $this->task->delete($id);
    }

    public function changeDeadline(int $id, string $date): ?TaskDto
    {
        $model = $this->findById($id);

        if (!$model) {
            return null;
        }

        $this->update($id, ['due_date' => $date]);

        return $model;
    }

    public function changeStatus(int $id, string $status): ?TaskDto
    {
        $model = $this->findById($id);

        if (!$model) {
            return null;
        }

        $this->update($id, ['status' => $status]);
        event(new TaskStatus(
            task_id: $model->id,
            oldValue: ['oldStatus' => $model->status],
            newValue: ['newStatus' => $status],
        ));

        return $model;
    }

    public function changeRelated(int $id, int $relatedId, string $relatedType): ?TaskDto
    {
        $model = $this->findById($id);

        if (!$model) {
            return null;
        }

        $this->task->update($id, [
            'related_id' => $relatedId,
            'related_type' => $relatedType,
        ]);

        return $model;
    }

    public function changeAssigned(int $id, int $assigned): ?TaskDto
    {
        $model = $this->findById($id);

        if (!$model) {
            return null;
        }

        $this->update($id, ['assigned_to' => $assigned]);
        event(new ChangeAssigned(
            task_id: $id,
            oldValue: ['oldValue' => $model->assigned_to],
            newValue: ['newValue' => $assigned],
        ));

        return $model;
    }
}

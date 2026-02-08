<?php

namespace App\Services;

use App\Events\ChangeAssigned;
use App\Events\TaskStatus;
use App\Observers\AuditObserver;
use App\Repository\Eloquent\Interfaces\ClientRepositoryInterface;
use App\Repository\Eloquent\Interfaces\DealRepositoryInterface;
use App\Repository\Eloquent\Interfaces\TaskRepositoryInterface;

class TaskService
{
    public function __construct(
        protected TaskRepositoryInterface $task,
        protected AuditObserver $obs,
        protected ClientRepositoryInterface $clients,
        protected DealRepositoryInterface $deals,
    ) {}

    public function index()
    {
        return $this->task->index();
    }

    public function findById(int $id)
    {
        return $this->task->findById($id);
    }

    public function findByUser(int $id)
    {
        return $this->task->findById($id);
    }

    public function create(array $data)
    {
        $model = $this->task->create($data);
        event(new ChangeAssigned(
                task_id: $model->id,
                oldValue: ['oldValue' => $model->assigned_to],
                newValue: ['newValue' => $data['assigned_to']],
            ));
        $this->obs->create($model);

        return $model;
    }

    public function update(int $id, array $data)
    {
        if (!$this->task->findById($id)) {
            return null;
        }

        $model = $this->task->update($id, $data);

        if ($data['assigned_to']) {
            event(new ChangeAssigned(
                task_id: $id,
                oldValue: ['oldValue' => $model->assigned_to],
                newValue: ['newValue' => $data['assigned_to']],
            ));
        }

        $this->obs->update($model);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->findById($id);

        if (!$model) {
            return false;
        }

        $this->obs->delete($model);

        return $this->task->delete($id);
    }

    public function changeDeadline(int $id, string $date)
    {
        $model = $this->findById($id);

        if (!$model) {
            return null;
        }

        $model->update(['due_date' => $date]);
        $this->obs->update($model);

        return $model;
    }

    public function changeStatus(int $id, string $status)
    {
        $model = $this->findById($id);

        if (!$model) {
            return null;
        }

        $model->update(['status' => $status]);
        event(new TaskStatus(
            task_id: $model->id,
            oldValue: ['oldStatus' => $model->status],
            newValue: ['newStatus' => $status],
        ));

        return $model;
    }

    public function changeRelated(int $id, int $relatedId, string $relatedType)
    {
        $model = $this->findById($id);

        if (!$model) {
            return false;
        }

        $this->task->update($id, [
            'related_id' => $relatedId,
            'related_type' => $relatedType,
        ]);
        $this->obs->update($model);

        return $model;
    }

    public function changeAssigned(int $id, string $assigned)
    {
        $model = $this->findById($id);

        if (!$model) {
            return null;
        }

        $model->update(['assigned_to' => $assigned]);
        event(new ChangeAssigned(
            task_id: $id,
            oldValue: ['oldValue' => $model->assigned_to],
            newValue: ['newValue' => $assigned],
        ));

        return $model;
    }
}

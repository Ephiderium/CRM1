<?php

namespace App\Repository\Eloquent;

use App\Dto\TaskDto;
use App\Models\Task;
use App\Repository\Eloquent\Interfaces\TaskRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskRepository implements TaskRepositoryInterface
{
    public function index(): array
    {
        return Task::get()
            ->map(callback: fn (Task $task) => TaskDto::fromModel($task))
            ->all();
    }

    public function findById(int $id): TaskDto
    {
        return TaskDto::fromModel(Task::find($id));
    }

    public function findByUser(int $id): array
    {
        return Task::where('assigned_to', $id)
            ->get()
            ->map(callback: fn (Task $task) => TaskDto::fromModel($task))
            ->all();
    }

    public function create(array $data): TaskDto
    {
        return TaskDto::fromModel(Task::create($data));
    }

    public function update(int $id, array $data): TaskDto
    {
        $task = Task::find($id);
        $task->update($data);
        $task->refresh();

        return TaskDto::fromModel($task);
    }

    public function delete(int $id): bool
    {
        $task = Task::find($id);
        return $task->delete();
    }

    public function changeDeadline(int $id, string $date): TaskDto
    {
        $task = Task::find($id);
        $task->update([
            'due_date' => $date,
        ]);
        $task->refresh();

        return TaskDto::fromModel($task);
    }

    public function changeStatus(int $id, string $status): TaskDto
    {
        $task = Task::find($id);
        $task->update([
            'status' => $status,
        ]);
        $task->refresh();

        return TaskDto::fromModel($task);
    }

    public function changeRelated(int $id, int $relatedId, string $relatedType): TaskDto
    {
        $task = Task::find($id);
        $task->update([
            'related_type' => $relatedType,
            'related_id' => $relatedId,
        ]);
        $task->refresh();

        return TaskDto::fromModel($task);
    }

    public function deadline(): void
    {
        $overdues = Task::where('due_date', '<=', now())
            ->when('status', '!=', 'overdue')
            ->update(['status' => 'overdue']);
    }
}

<?php

namespace App\Repository\Eloquent;

use App\Models\Task;
use App\Repository\Eloquent\Interfaces\TaskRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskRepository implements TaskRepositoryInterface
{
    public function index(): LengthAwarePaginator
    {
        return Task::paginate(20);
    }

    public function findById(int $id): Task
    {
        return Task::find($id);
    }

    public function findByUser(int $id): LengthAwarePaginator
    {
        return Task::where('assigned_to', $id)->paginate(20);
    }

    public function create(array $data): Task
    {
        return Task::create($data);
    }

    public function update(int $id, array $data): Task
    {
        $task = Task::find($id);
        $task->update($data);
        $task->refresh();

        return $task;
    }

    public function delete(int $id): bool
    {
        $task = Task::find($id);
        return $task->delete();
    }

    public function changeDeadline(int $id, string $date): Task
    {
        $task = Task::find($id);
        $task->update([
            'due_date' => $date,
        ]);
        $task->refresh();

        return $task;
    }

    public function changeStatus(int $id, string $status): Task
    {
        $task = Task::find($id);
        $task->update([
            'status' => $status,
        ]);
        $task->refresh();

        return $task;
    }

    public function changeRelated(int $id, int $relatedId, string $relatedType): Task
    {
        $task = Task::find($id);
        $task->update([
            'related_type' => $relatedType,
            'related_id' => $relatedId,
        ]);
        $task->refresh();

        return $task;
    }

    public function deadline(): void
    {
        $overdues = Task::where('due_date', '<=', now())
        ->when('status', '!=', 'overdue')
        ->update(['status' => 'overdue']);
    }
}

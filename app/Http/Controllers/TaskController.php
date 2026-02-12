<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $service,
    ) {}

    public function index()
    {
        return TaskResource::collection($this->service->index());
    }

    public function find(int $id): ?TaskResource
    {
        return new TaskResource($this->service->findById($id));
    }

    public function findByUser(int $id): ?TaskResource
    {
        $task = $this->service->findById($id);
        return $task ? new TaskResource($this->service->findByUser($id)) : null;
    }

    public function store(CreateTaskRequest $request): TaskResource
    {
        return new TaskResource($this->service->create($request->validated()));
    }

    public function update(int $id, UpdateTaskRequest $request): ?TaskResource
    {
        $task = $this->service->findById($id);
        return $task ? new TaskResource($this->service->update($id, $request->validated())) : null;
    }

    public function destroy(int $id): bool
    {
        return $this->service->delete($id);
    }

    public function changeDeadline(int $id, UpdateTaskRequest $request): ?TaskResource
    {
        $task = $this->service->findById($id);
        return $task ? new TaskResource($this->service->changeDeadline($id, $request->validated('date'))) : null;
    }

    public function changeStatus(int $id, UpdateTaskRequest $request): ?TaskResource
    {
        $task = $this->service->findById($id);
        return $task ? new TaskResource($this->service->changeStatus($id, $request->validated('status'))) : null;
    }

    public function changeRelated(int $id, UpdateTaskRequest $request): ?TaskResource
    {
        $task = $this->service->findById($id);
        return $task ? new TaskResource($this->service
            ->changeRelated($id, $request->validated('relatedId'), $request->validated('relatedType'))) : null;
    }

    public function changeAssigned(int $id, UpdateTaskRequest $request): ?TaskResource
    {
        $task = $this->service->findById($id);
        return $task ? new TaskResource($this->service->changeAssigned($id, $request->validated('assigned'))) : null;
    }
}

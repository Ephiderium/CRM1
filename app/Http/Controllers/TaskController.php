<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $service,
    ) {}

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection|JsonResponse
    {
        return TaskResource::collection($this->service->index());
    }

    public function find(int $id): TaskResource|JsonResponse
    {
        return new TaskResource($this->service->findById($id));
    }

    public function findByUser(int $id): TaskResource|JsonResponse
    {
        return new TaskResource($this->service->findByUser($id));
    }

    public function store(CreateTaskRequest $request): TaskResource|JsonResponse
    {
        return new TaskResource($this->service->create($request->validated()));
    }

    public function update(int $id, UpdateTaskRequest $request): TaskResource|JsonResponse
    {
        return new TaskResource($this->service->update($id, $request->validated()));
    }

    public function destroy(int $id): bool|JsonResponse
    {
        return $this->service->delete($id);
    }

    public function changeDeadline(int $id, UpdateTaskRequest $request): TaskResource|JsonResponse
    {
        return new TaskResource($this->service->changeDeadline($id, $request->validated('due_date')));
    }

    public function changeStatus(int $id, UpdateTaskRequest $request): TaskResource|JsonResponse
    {
        return new TaskResource($this->service->changeStatus($id, $request->validated('status')));
    }

    public function changeRelated(int $id, UpdateTaskRequest $request): TaskResource|JsonResponse
    {
        return new TaskResource($this->service
            ->changeRelated($id, $request->validated('related_id'), $request->validated('related_type')));
    }

    public function changeAssigned(int $id, UpdateTaskRequest $request): TaskResource|JsonResponse
    {
        return new TaskResource($this->service->changeAssigned($id, $request->validated('assigned_to')));
    }
}

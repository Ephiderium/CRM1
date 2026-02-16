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
        try {
            return TaskResource::collection($this->service->index());
        } catch (\Exception $e) {
            return response()->json(['error' => 'index: ' . $e->getMessage()], 500);
        }
    }

    public function find(int $id): TaskResource|JsonResponse
    {
        try {
            return new TaskResource($this->service->findById($id));
        } catch (\Exception $e) {
            return response()->json(['error' => 'find: ' . $e->getMessage()], 500);
        }
    }

    public function findByUser(int $id): TaskResource|JsonResponse
    {
        try {
            return new TaskResource($this->service->findByUser($id));
        } catch (\Exception $e) {
            return response()->json(['error' => 'findByUser: ' . $e->getMessage()], 500);
        }
    }

    public function store(CreateTaskRequest $request): TaskResource|JsonResponse
    {
        try {
            return new TaskResource($this->service->create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'store: ' . $e->getMessage()], 500);
        }
    }

    public function update(int $id, UpdateTaskRequest $request): TaskResource|JsonResponse
    {
        try {
            return new TaskResource($this->service->update($id, $request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'update: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): bool|JsonResponse
    {
        try {
            return $this->service->delete($id);
        } catch (\Exception $e) {
            return response()->json(['error' => 'destroy: ' . $e->getMessage()], 500);
        }
    }

    public function changeDeadline(int $id, UpdateTaskRequest $request): TaskResource|JsonResponse
    {
        try {
            return new TaskResource($this->service->changeDeadline($id, $request->validated('due_date')));
        } catch (\Exception $e) {
            return response()->json(['error' => 'changeDeadline: ' . $e->getMessage()], 500);
        }
    }

    public function changeStatus(int $id, UpdateTaskRequest $request): TaskResource|JsonResponse
    {
        try {
            return new TaskResource($this->service->changeStatus($id, $request->validated('status')));
        } catch (\Exception $e) {
            return response()->json(['error' => 'changeStatus: ' . $e->getMessage()], 500);
        }
    }

    public function changeRelated(int $id, UpdateTaskRequest $request): TaskResource|JsonResponse
    {
        try {
            return new TaskResource($this->service
                ->changeRelated($id, $request->validated('related_id'), $request->validated('related_type')));
        } catch (\Exception $e) {
            return response()->json(['error' => 'changeRelated: ' . $e->getMessage()], 500);
        }
    }

    public function changeAssigned(int $id, UpdateTaskRequest $request): TaskResource|JsonResponse
    {
        try {
            return new TaskResource($this->service->changeAssigned($id, $request->validated('assigned_to')));
        } catch (\Exception $e) {
            return response()->json(['error' => 'changeAssigned: ' . $e->getMessage()], 500);
        }
    }
}

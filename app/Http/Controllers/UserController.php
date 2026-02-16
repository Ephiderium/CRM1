<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeRoleRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $service) {}

    public function changePassword(ResetPasswordRequest $request): bool|JsonResponse
    {
        try {
            return $this->service->changePassword($request);
        } catch (\Exception $e) {
            return response()->json(['error' => 'changePassword: ' . $e->getMessage()], 500);
        }
    }

    public function disableUser(UpdateUserRequest $request): bool|JsonResponse
    {
        try {
            return $this->service->disableUser($request->validated('email'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'disableUser: ' . $e->getMessage()], 500);
        }
    }

    public function changeRole(ChangeRoleRequest $request): bool|JsonResponse
    {
        try {
            return $this->service->changeRole($request->validated());
        } catch (\Exception $e) {
            return response()->json(['error' => 'changeRole: ' . $e->getMessage()], 500);
        }
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection|JsonResponse
    {
        try {
            return UserResource::collection($this->service->index());
        } catch (\Exception $e) {
            return response()->json(['error' => 'index: ' . $e->getMessage()], 500);
        }
    }

    public function find(int $id): UserResource|JsonResponse
    {
        try {
            return new UserResource($this->service->findById($id));
        } catch (\Exception $e) {
            return response()->json(['error' => 'find: ' . $e->getMessage()], 500);
        }
    }

    public function findByEmail(UpdateUserRequest $request): UserResource|JsonResponse
    {
        try {
            return new UserResource($this->service->findByEmail($request->validated('email')));
        } catch (\Exception $e) {
            return response()->json(['error' => 'findByEmail: ' . $e->getMessage()], 500);
        }
    }

    public function store(CreateUserRequest $request): UserResource|JsonResponse
    {
        try {
            return new UserResource($this->service->create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'store: ' . $e->getMessage()], 500);
        }
    }

    public function update(int $id, UpdateUserRequest $request): UserResource|JsonResponse
    {
        try {
            return new UserResource($this->service->update($id, $request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'update: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): bool|JsonResponse
    {
        try {
            return $this->service->deleteById($id);
        } catch (\Exception $e) {
            return response()->json(['error' => 'destroy: ' . $e->getMessage()], 500);
        }
    }
}

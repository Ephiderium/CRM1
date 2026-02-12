<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeRoleRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $service) {}

    public function createAdmin(CreateUserRequest $request): UserResource
    {
        return new UserResource($this->service->createAdmin($request->validated()));
    }

    public function changePassword(ResetPasswordRequest $request): bool
    {
        return $this->service->changePassword($request);
    }

    public function disableUser(UpdateUserRequest $request): bool
    {
        return $this->service->disableUser($request->validated('email'));
    }

    public function changeRole(ChangeRoleRequest $request): bool
    {
        return $this->service->changeRole($request->validated());
    }

    public function index()
    {
        return UserResource::collection($this->service->index());
    }

    public function find(int $id): UserResource
    {
        return new UserResource($this->service->findById($id));
    }

    public function findByEmail(UpdateUserRequest $request): UserResource
    {
        return new UserResource($this->service->findByEmail($request->validated('email')));
    }

    public function store(CreateUserRequest $request): UserResource
    {
        return new UserResource($this->service->create($request->validated()));
    }

    public function update(int $id, UpdateUserRequest $request): UserResource
    {
        return new UserResource($this->service->update($id, $request->validated()));
    }

    public function destroy(int $id): bool
    {
        return $this->service->deleteById($id);
    }
}

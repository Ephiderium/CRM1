<?php

namespace App\Services;

use App\Dto\UserDto;
use App\Repository\Eloquent\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(public UserRepositoryInterface $users) {}

    public function createAdmin(array $data): UserDto
    {
        $data['role'] = 'admin';
        $admin = $this->users->create($data);

        return $admin;
    }

    public function createUser(array $data): UserDto
    {
        $user = $this->users->create($data);

        return $user;
    }

    public function changePassword($request): bool
    {
        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return false;
        }

        /** @var \App\Models\User $user */
        $updated = $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        if ($updated) {
            $user->tokens()->delete();
            return true;
        }

        return false;
    }

    public function disableUser(string $email): bool
    {
        return $this->users->disableUser($email);
    }

    public function changeRole(array $data): bool
    {
        return $this->users->changeRole($data);
    }
    public function index()
    {
        return $this->users->index();
    }

    public function findById(int $id): ?UserDto
    {
        return $this->users->findById($id);
    }

    public function findByEmail(string $email): ?UserDto
    {
        return $this->users->findByEmail($email);
    }

    public function create(array $data): UserDto
    {
        return $this->users->create($data);
    }

    public function update(int $id, array $data): ?UserDto
    {
        return $this->users->update($id, $data);
    }

    public function deleteById(int $id): bool
    {
        return $this->users->deleteById($id);
    }
}

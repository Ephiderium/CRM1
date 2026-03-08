<?php

namespace App\Repository\Eloquent;

use App\Dto\UserDto;
use App\Events\UserRegisteredEvent;
use App\Models\User;
use App\Repository\Eloquent\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): UserDto
    {
        if ($data['role']) {
            $role = $data['role'];
            unset($data['role']);
        }

        $model = User::create($data);
        $model->assignRole($role);
        event(new UserRegisteredEvent($model));

        return UserDto::fromModel($model);
    }

    public function findById(int $id): ?UserDto
    {
        return UserDto::fromModel(User::find($id));
    }

    public function findByEmail(string $email): ?UserDto
    {
        return UserDto::fromModel(User::where('email', $email)->first());
    }

    public function deleteById(int $id): bool
    {
        return User::find($id)->delete();
    }

    public function update(int $id, array $data): ?UserDto
    {
        $user = User::find($id);

        if (!$user) {
            return null;
        }

        $user->update($data);
        $user->fresh();

        return UserDto::fromModel($user);
    }

    public function index(): array
    {
        return User::get()
            ->map(callback: fn (User $user) => UserDto::fromModel($user))
            ->all();
    }

    public function disableUser(string $email): bool
    {
        $user = User::where('email', $email)->first();
        $user->syncRoles([]);
        $user->syncPermissions([]);
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        $user->currentAccessToken()?->delete();
        $this->update($user->id, ['is_active' => false]);

        return true;
    }

    public function changeRole(array $data): bool
    {
        $user = User::where('email', $data['email'])->first();
        $user->syncRoles(strtolower($data['role']));

        return true;
    }
}

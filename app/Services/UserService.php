<?php

namespace App\Services;

use App\Repository\Eloquent\Interfaces\UserRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(public UserRepositoryInterface $users) {}

    public function createAdmin(array $data)
    {
        $admin = $this->users->create($data);
        $admin->assignRole('admin');

        return $admin;
    }

    public function createUser(array $data)
    {
        $role = $data['role'];
        unset($data['role']);
        $user = $this->users->create($data);
        $user->assignRole($role);

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
        $user = $this->users->findByEmail($email);
        $user->syncRoles([]);
        $user->syncPermissions([]);
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        Auth::logout();

        return true;
    }

    public function changeRole(array $data): bool
    {
        $user = $this->users->findByEmail($data['email']);
        $user->syncRoles(strtolower($data['role']));

        return true;
    }
}

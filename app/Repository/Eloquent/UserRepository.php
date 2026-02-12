<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Eloquent\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function deleteById(int $id): bool
    {
        return User::find($id)->delete();
    }

    public function update(int $id, array $data): ?User
    {
        $user = User::find($id);

        if (!$user) {
            return null;
        }

        $user->update($data);
        $user->fresh();

        return $user;
    }

    public function index(): LengthAwarePaginator
    {
        return User::paginate(20);
    }
}

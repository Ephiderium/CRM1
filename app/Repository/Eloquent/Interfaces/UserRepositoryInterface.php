<?php

namespace App\Repository\Eloquent\Interfaces;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function index(): LengthAwarePaginator;
    public function findById(int $id): ?User;
    public function findByEmail(string $email): ?User;
    public function create(array $data): User;
    public function update(int $id, array $data): ?User;
    public function deleteById(int $id): bool;
}

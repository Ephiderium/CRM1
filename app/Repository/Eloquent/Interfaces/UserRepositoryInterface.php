<?php

namespace App\Repository\Eloquent\Interfaces;

use App\Dto\UserDto;

interface UserRepositoryInterface
{
    public function index(): array;
    public function findById(int $id): ?UserDto;
    public function findByEmail(string $email): ?UserDto;
    public function create(array $data): UserDto;
    public function update(int $id, array $data): ?UserDto;
    public function deleteById(int $id): bool;
    public function disableUser(string $email): bool;
    public function changeRole(array $data): bool;
}

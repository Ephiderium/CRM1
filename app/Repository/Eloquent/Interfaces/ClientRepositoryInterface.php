<?php

namespace App\Repository\Eloquent\Interfaces;

use App\Models\Client;
use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ClientRepositoryInterface
{
    public function index($request): LengthAwarePaginator;
    public function create(array $data): Client;
    public function findById(int $id): ?Client;
    public function findByEmail(string $email): Client;
    public function update(int $id, array$data): Client;
    public function delete(int $id): bool;
    public function forceDelete(int $id): bool;
    public function createComment(int $id, array $data): ?Comment;
}

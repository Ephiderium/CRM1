<?php

namespace App\Repository\Eloquent\Interfaces;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

interface ClientRepositoryInterface
{
    public function index($request): Collection;
    public function create(array $data): Client;
    public function findById(int $id): ?Client;
    public function findByEmail(string $email): Client;
    public function update(int $id, array$data): Client;
    public function delete(int $id): bool;
    public function forceDelete(int $id): bool;
}

<?php

namespace App\Repository\Eloquent\Interfaces;

use App\Models\Deal;
use Illuminate\Database\Eloquent\Collection;

interface DealRepositoryInterface
{
    public function index(): Collection;
    public function findById(int $id): ?Deal;
    public function findByManager(int $id): Collection;
    public function findByClient(int $id): Collection;
    public function create(array $data): Deal;
    public function update(int $id, array $data): Deal;
    public function delete(int $id): bool;
    public function changeStage(int $id, string $stage): ?Deal;
    public function changeAmount(int $id, int $amount): ?Deal;
}

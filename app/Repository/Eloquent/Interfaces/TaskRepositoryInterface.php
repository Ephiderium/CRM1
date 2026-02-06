<?php

namespace App\Repository\Eloquent\Interfaces;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryInterface
{
    public function index(): Collection;
    public function findById(int $id): Task;
    public function findByUser(int $id): Collection;
    public function create(array $data): Task;
    public function update(int $id, array $data): Task;
    public function delete(int $id): bool;
    public function changeDeadline(int $id, string $date): Task;
    public function changeStatus(int $id, string $status): Task;
    public function changeRelated(int $id, int $relatedId, string $relatedType): Task;
}

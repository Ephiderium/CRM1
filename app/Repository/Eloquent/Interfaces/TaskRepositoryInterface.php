<?php

namespace App\Repository\Eloquent\Interfaces;

use App\Dto\TaskDto;

interface TaskRepositoryInterface
{
    public function index(): array;
    public function findById(int $id): TaskDto;
    public function findByUser(int $id): array;
    public function create(array $data): TaskDto;
    public function update(int $id, array $data): TaskDto;
    public function delete(int $id): bool;
    public function changeDeadline(int $id, string $date): TaskDto;
    public function changeStatus(int $id, string $status): TaskDto;
    public function changeRelated(int $id, int $relatedId, string $relatedType): TaskDto;
    public function deadline(): void;
}

<?php

namespace App\Repository\Eloquent\Interfaces;

use App\Dto\DealDto;

interface DealRepositoryInterface
{
    public function index(): array;
    public function findById(int $id): ?DealDto;
    public function findByManager(int $id): array;
    public function findByClient(int $id): array;
    public function create(array $data): DealDto;
    public function update(int $id, array $data): DealDto;
    public function delete(int $id): bool;
    public function changeStage(int $id, string $stage): ?DealDto;
    public function changeAmount(int $id, int $amount): ?DealDto;
    public function createComment(int $id, array $data);
}

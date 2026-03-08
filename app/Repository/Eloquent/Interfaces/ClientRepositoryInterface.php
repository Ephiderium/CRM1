<?php

namespace App\Repository\Eloquent\Interfaces;

use App\Dto\ClientDto;
use App\Dto\CommentDto;

interface ClientRepositoryInterface
{
    public function index($request): array;
    public function create(array $data): ClientDto;
    public function findById(int $id): ?ClientDto;
    public function findByEmail(string $email): ClientDto;
    public function update(int $id, array$data): ClientDto;
    public function delete(int $id): bool;
    public function forceDelete(int $id): bool;
    public function createComment(int $id, array $data): ?CommentDto;
}

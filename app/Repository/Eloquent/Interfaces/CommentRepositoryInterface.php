<?php

namespace App\Repository\Eloquent\Interfaces;

use App\Dto\CommentDto;

interface CommentRepositoryInterface
{
    public function index(): array;
    public function findById(int $id): CommentDto;
    public function findByUser(int $id): array;
    public function create(array $data): CommentDto;
    public function update(int $id, array $data): CommentDto;
    public function delete(int $id): bool;

}

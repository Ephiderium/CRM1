<?php

namespace App\Repository\Eloquent\Interfaces;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

interface CommentRepositoryInterface
{
    public function index(): Collection;
    public function findById(int $id): Comment;
    public function findByUser(int $id): Collection;
    public function create(array $data): Comment;
    public function update(int $id, array $data): Comment;
    public function delete(int $id): bool;

}

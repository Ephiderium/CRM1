<?php

namespace App\Repository\Eloquent\Interfaces;

use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CommentRepositoryInterface
{
    public function index(): LengthAwarePaginator;
    public function findById(int $id): Comment;
    public function findByUser(int $id): LengthAwarePaginator;
    public function create(array $data): Comment;
    public function update(int $id, array $data): Comment;
    public function delete(int $id): bool;

}

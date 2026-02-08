<?php

namespace App\Repository\Eloquent;

use App\Models\Comment;
use App\Repository\Eloquent\Interfaces\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository implements CommentRepositoryInterface
{
    public function index(): Collection
    {
        return Comment::all();
    }

    public function findById(int $id): Comment
    {
        return Comment::find($id);
    }

    public function findByUser(int $id): Collection
    {
        return Comment::where('user_id', $id)->get();
    }

    public function create(array $data): Comment
    {
        return Comment::create($data);
    }

    public function update(int $id, array $data): Comment
    {
        $model = Comment::find($id);
        $model->update($data);
        $model->refresh();

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = Comment::find($id);
        return $model->delete();
    }

}

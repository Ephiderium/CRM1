<?php

namespace App\Repository\Eloquent;

use App\Models\Comment;
use App\Repository\Eloquent\Interfaces\CommentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CommentRepository implements CommentRepositoryInterface
{
    public function index(): LengthAwarePaginator
    {
        return Comment::paginate(20);
    }

    public function findById(int $id): Comment
    {
        return Comment::find($id);
    }

    public function findByUser(int $id): LengthAwarePaginator
    {
        return Comment::where('user_id', $id)->paginate(20);
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

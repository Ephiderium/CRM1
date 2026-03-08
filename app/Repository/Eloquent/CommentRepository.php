<?php

namespace App\Repository\Eloquent;

use App\Dto\CommentDto;
use App\Models\Comment;
use App\Repository\Eloquent\Interfaces\CommentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CommentRepository implements CommentRepositoryInterface
{
    public function index(): array
    {
        return Comment::get()
            ->map(fn (Comment $comment) => CommentDto::fromModel($comment))
            ->all();
    }

    public function findById(int $id): CommentDto
    {
        return CommentDto::fromModel(Comment::find($id));
    }

    public function findByUser(int $id): array
    {
        return Comment::where('user_id', $id)
            ->get()
            ->map(fn (Comment $comment) => CommentDto::fromModel($comment))
            ->all();
    }

    public function create(array $data): CommentDto
    {
        return CommentDto::fromModel(Comment::create($data));
    }

    public function update(int $id, array $data): CommentDto
    {
        $model = Comment::find($id);
        $model->update($data);
        $model->refresh();

        return CommentDto::fromModel($model);
    }

    public function delete(int $id): bool
    {
        $model = Comment::find($id);
        return $model->delete();
    }
}

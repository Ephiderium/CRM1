<?php

namespace App\Repository\Eloquent;

use App\Dto\CommentDto;
use App\Dto\DealDto;
use App\Models\Comment;
use App\Models\Deal;
use App\Repository\Eloquent\Interfaces\DealRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DealRepository implements DealRepositoryInterface
{
    public function index(): array
    {
        return Deal::get()
            ->map(callback: fn (Deal $deal) => DealDto::fromModel($deal))
            ->all();
    }

    public function findById(int $id): ?DealDto
    {
        return DealDto::fromModel(Deal::find($id));
    }

    public function findByManager(int $id): array
    {
        return Deal::where('manager_id', $id)
            ->get()
            ->map(callback: fn (Deal $deal) => DealDto::fromModel($deal))
            ->all();;
    }

    public function findByClient(int $id): array
    {
        return Deal::where('client_id', $id)
            ->get()
            ->map(callback: fn (Deal $deal) => DealDto::fromModel($deal))
            ->all();;;
    }

    public function create(array $data): DealDto
    {
        return DealDto::fromModel(Deal::create($data));
    }

    public function update(int $id, array $data): DealDto
    {
        $deal = Deal::find($id);
        $deal->update($data);
        $deal->refresh();

        return DealDto::fromModel($deal);
    }

    public function delete(int $id): bool
    {
        $deal = Deal::find($id);
        return $deal->delete();
    }

    public function changeStage(int $id, string $stage): ?DealDto
    {
        $deal = Deal::find($id);
        $deal->update(['stage' => $stage]);
        $deal->refresh();

        return DealDto::fromModel($deal);
    }

    public function changeAmount(int $id, int $amount): ?DealDto
    {
        $deal = Deal::find($id);
        $deal->update(['amount' => $amount]);
        $deal->refresh();

        return DealDto::fromModel($deal);
    }

    public function createComment(int $id, array $data): ?CommentDto
    {
        $model = Deal::find($id);
        $model->comments()->create($data);

        return CommentDto::fromModel(Comment::where('body', $data['body'])
            ->where('user_id', $data['user_id'])
            ->first());
    }
}

<?php

namespace App\Repository\Eloquent;

use App\Models\Comment;
use App\Models\Deal;
use App\Repository\Eloquent\Interfaces\DealRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DealRepository implements DealRepositoryInterface
{
    public function index(): LengthAwarePaginator
    {
        return Deal::paginate(20);
    }

    public function findById(int $id): ?Deal
    {
        return Deal::find($id);
    }

    public function findByManager(int $id): LengthAwarePaginator
    {
        return Deal::where('manager_id', $id)->paginate(20);
    }

    public function findByClient(int $id): LengthAwarePaginator
    {
        return Deal::where('client_id', $id)->paginate(20);
    }

    public function create(array $data): Deal
    {
        return Deal::create($data);
    }

    public function update(int $id, array $data): Deal
    {
        $deal = Deal::find($id);
        $deal->update($data);
        $deal->refresh();

        return $deal;
    }

    public function delete(int $id): bool
    {
        $deal = Deal::find($id);
        return $deal->delete();
    }

    public function changeStage(int $id, string $stage): ?Deal
    {
        $deal = Deal::find($id);
        $deal->update(['stage' => $stage]);
        $deal->refresh();

        return $deal;
    }

    public function changeAmount(int $id, int $amount): ?Deal
    {
        $deal = Deal::find($id);
        $deal->update(['amount' => $amount]);
        $deal->refresh();

        return $deal;
    }

    public function createComment(int $id, array $data): ?Comment
    {
        $model = Deal::find($id);
        $model->comments()->create($data);

        return Comment::where('body', $data['body'])
            ->where('user_id', $data['user_id'])
            ->first();
    }
}

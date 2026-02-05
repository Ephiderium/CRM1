<?php

namespace App\Repository\Eloquent;

use App\Models\Deal;
use App\Repository\Eloquent\Interfaces\DealRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DealRepository implements DealRepositoryInterface
{
    public function index(): Collection
    {
        return Deal::all();
    }

    public function findById(int $id): ?Deal
    {
        return Deal::find($id);
    }

    public function findByManager(int $id): Collection
    {
        return Deal::where('manager_id', $id)->get();
    }

    public function findByClient(int $id): Collection
    {
        return Deal::where('client_id', $id)->get();
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

}

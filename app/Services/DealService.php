<?php

namespace App\Services;

use App\Events\DealStage;
use App\Repository\Eloquent\Interfaces\DealRepositoryInterface;


class DealService
{
    public function __construct(
        protected DealRepositoryInterface $deals
    ) {}

    public function index()
    {
        return $this->deals->index();
    }

    public function findById(int $id)
    {
        return $this->deals->findById($id);
    }

    public function findByManager(int $id)
    {
        return $this->deals->findByManager($id);
    }

    public function findByClient(int $id)
    {
        return $this->deals->findByClient($id);
    }

    public function create(array $data)
    {
        return $this->deals->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->deals->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->deals->delete($id);
    }
    public function changeStage(int $id, string $stage)
    {
        $deal = $this->deals->changeStage($id, $stage);

        if (!$deal) {
            return null;
        } else {
            event(new DealStage(
                deal_id: $deal->id,
                oldValue: $deal->stage,
                newValue: $stage,
            ));
        }
    }

    public function changeAmount(int $id, int $amount)
    {
        return $this->deals->changeAmount($id, $amount);
    }
}

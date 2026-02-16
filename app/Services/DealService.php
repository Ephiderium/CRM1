<?php

namespace App\Services;

use App\Events\DealStage;
use App\Observers\AuditObserver;
use App\Repository\Eloquent\Interfaces\DealRepositoryInterface;


class DealService
{
    public function __construct(
        protected DealRepositoryInterface $deals,
        protected AuditObserver $obs,
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
        $model = $this->deals->create($data);
        $this->obs->delete($model);

        return $model;
    }

    public function update(int $id, array $data)
    {
        if (!$this->deals->findById($id)) {
            return null;
        }

        $model = $this->deals->update($id, $data);
        $this->obs->update($model);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->deals->findById($id);

        if(!$model) {
            return false;
        }

        $this->obs->delete($model);

        return $this->deals->delete($id);
    }

    public function changeStage(int $id, string $stage)
    {
        $deal = $this->deals->findById($id);
        $amount = $deal->amount;

        if ($amount <= 0 && $stage === 'won') {
            return null;
        }

        $deal = $this->deals->changeStage($id, $stage);

        if (!$deal) {
            return null;
        } else {
            event(new DealStage(
                deal_id: $deal->id,
                oldValue: ['oldStage' => $deal->stage],
                newValue: ['newStage' => $stage],
            ));
        }

        return $deal;
    }

    public function changeAmount(int $id, int $amount)
    {
        $model = $this->deals->changeAmount($id, $amount);
        $this->obs->update($model);

        return $model;
    }
}

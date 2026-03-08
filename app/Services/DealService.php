<?php

namespace App\Services;

use App\Dto\DealDto;
use App\Events\DealStage;
use App\Repository\Eloquent\Interfaces\DealRepositoryInterface;
use PhpParser\Node\Expr\Array_;

class DealService
{
    public function __construct(
        protected DealRepositoryInterface $deals,
    ) {}

    public function index(): array
    {
        return $this->deals->index();
    }

    public function findById(int $id): ?DealDto
    {
        return $this->deals->findById($id);
    }

    public function findByManager(int $id): array
    {
        return $this->deals->findByManager($id);
    }

    public function findByClient(int $id): array
    {
        return $this->deals->findByClient($id);
    }

    public function create(array $data): DealDto
    {
        $model = $this->deals->create($data);

        return $model;
    }

    public function update(int $id, array $data): ?DealDto
    {
        if (!$this->deals->findById($id)) {
            return null;
        }

        $model = $this->deals->update($id, $data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->deals->findById($id);

        if(!$model) {
            return false;
        }

        return $this->deals->delete($id);
    }

    public function changeStage(int $id, string $stage): ?DealDto
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

    public function changeAmount(int $id, int $amount): ?DealDto
    {
        $model = $this->deals->changeAmount($id, $amount);

        return $model;
    }
}

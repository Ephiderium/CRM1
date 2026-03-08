<?php

namespace App\Dto;

use App\Models\Deal;

class DealDto
{
    public function __construct(
        public int $id,
        public int $client_id,
        public int $manager_id,
        public int $amount,
        public string $stage,
        public string $expected_close_date
    ) {}

    public static function fromModel(Deal $model): self
    {
        return new self(
            id: $model->id,
            client_id: $model->client_id,
            manager_id: $model->manager_id,
            amount: $model->amount,
            stage: $model->stage,
            expected_close_date: $model->expected_close_date
        );
    }
}

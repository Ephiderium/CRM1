<?php

namespace App\Dto;

use App\Models\Client;

class ClientDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $phone,
        public string $company,
        public string $source,
        public int $manager_id,
        public string $status,
    ) {}

    public static function fromModel(Client $model): self
    {
        return new self(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            phone: $model->phone,
            company: $model->company,
            source: $model->source,
            manager_id: $model->manager_id,
            status: $model->status,
        );
    }
}

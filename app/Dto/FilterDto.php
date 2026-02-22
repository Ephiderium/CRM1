<?php

namespace App\Dto;

class FilterDto
{
    public function __construct(
        public ?string $name,
        public ?string $email,
        public ?string $phone,
        public ?string $company,
        public ?string $source,
        public ?int $manager_id,
        public ?string $status,
    ) {}

    public static function fromArray(array $data)
    {
        return new self(
        name: $data['name'] ?? null,
        email: $data['email'] ?? null,
        phone: $data['phone'] ?? null,
        company: $data['company'] ?? null,
        source: $data['source'] ?? null,
        manager_id: $data['manager_id'] ?? null,
        status: $data['status'] ?? null,
    );
    }
}

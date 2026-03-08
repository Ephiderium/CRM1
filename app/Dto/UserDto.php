<?php

namespace App\Dto;

use App\Models\User;

class UserDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $password,
        public int $is_active,
        public ?string $role,
    ) {}

    public static function fromModel(User | null $model): ?self
    {
        return $model ? new self(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            password: $model->password,
            is_active: $model->is_active,
            role: $model->getRoleNames()->first()
        ) : null;
    }
}

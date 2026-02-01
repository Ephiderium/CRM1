<?php

namespace App\Services;

use App\Repository\Eloquent\Interfaces\UserRepositoryInterface;

class UserService
{
    public function __construct(public UserRepositoryInterface $users) {}

    public function createAdmin(array $data)
    {
        $admin = $this->users->create($data);
        $admin->assignRole('admin');

        return $admin;
    }
}

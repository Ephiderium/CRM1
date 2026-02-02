<?php

namespace App\Services;

use App\Repository\Eloquent\ClientRepository;

class ClientService
{
    public function __construct(
        protected ClientRepository $clients
    ) {}

    public function index()
    {

    }

    public function create(array $data)
    {
        //
    }

    public function findByEmail(string $email)
    {
        //
    }

    public function update($data)
    {
        //
    }

    public function delete()
    {
        //
    }
}

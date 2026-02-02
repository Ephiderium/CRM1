<?php

namespace App\Repository\Eloquent;

use App\Models\Client;
use App\Repository\Eloquent\Interfaces\ClientRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ClientRepository implements ClientRepositoryInterface
{
    public function index(): Collection
    {
        return Client::all();
    }

    public function create(array $data): Client
    {
        return Client::create($data);
    }

    public function findById(int $id): Client
    {
        return Client::find($id);
    }

    public function findByEmail(string $email): Client
    {
        return Client::where('email', $email)->first();
    }

    public function update(int $id, array $data): Client
    {
        $user = Client::find($id);
        $user->update($data);
        $user->refresh();

        return $user;
    }

    public function deleteById(int $id): bool
    {
        $user = Client::find($id);
        return $user->delete();
    }
}

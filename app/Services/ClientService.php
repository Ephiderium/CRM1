<?php

namespace App\Services;

use App\Models\Client;
use App\Repository\Eloquent\ClientRepository;
use Illuminate\Database\Eloquent\Collection;

class ClientService
{
    public function __construct(
        protected ClientRepository $clients
    ) {}

    public function index($request): ?Collection
    {
        return $this->clients->index($request);
    }

    public function create(array $data)
    {
        return $this->clients->create($data);
    }

    public function findByEmail(string $email)
    {
        return $this->clients->findByEmail($email);
    }

    public function update(int $id, array $data)
    {
        if (!$this->clients->findById($id)) {
            return null;
        }

        return $this->clients->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->clients->delete($id);
    }

    public function forceDelete(int $id): bool
    {
        return $this->clients->forceDelete($id);
    }

    public function changeManager(int $clientId, int $managerId): ?Client
    {
        $client = $this->clients->findById($clientId);

        if (!$client) {
            return null;
        }

        if (!$client->update(['manager_id' => $managerId])) {
            return null;
        }

        $client->refresh();

        return $client;
    }
}

<?php

namespace App\Services;

use App\Models\Client;
use App\Observers\AuditObserver;
use App\Repository\Eloquent\ClientRepository;
use Illuminate\Database\Eloquent\Collection;

class ClientService
{
    public function __construct(
        protected ClientRepository $clients,
        protected AuditObserver $obs,
    ) {}

    public function index($request): ?Collection
    {
        return $this->clients->index($request);
    }

    public function create(array $data)
    {
        $model =  $this->clients->create($data);
        $this->obs->create($model);

        return $model;
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

        $model = $this->clients->update($id, $data);
        $this->obs->update($model);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->clients->findById($id);

        if(!$model) {
            return false;
        }

        $this->obs->delete($model);

        return $this->clients->delete($id);
    }

    public function forceDelete(int $id): bool
    {
        $model = $this->clients->findById($id);

        if(!$model) {
            return false;
        }

        $this->obs->forceDelete($model);

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

        $this->obs->update($client);

        return $client;
    }
}

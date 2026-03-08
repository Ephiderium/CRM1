<?php

namespace App\Services;

use App\Dto\ClientDto;
use App\Observers\AuditObserver;
use App\Repository\Eloquent\ClientRepository;
use Illuminate\Support\Facades\Auth;

class ClientService
{
    public function __construct(
        protected ClientRepository $clients,
    ) {}

    public function index($dto): array
    {
        return $this->clients->index($dto);
    }

    public function create(array $data): ClientDto
    {
        $data['manager_id'] = Auth::user()->id;
        $model =  $this->clients->create($data);

        return $model;
    }

    public function find(int $id): ?ClientDto
    {
        return $this->clients->findById($id);
    }

    public function findByEmail(string $email): ClientDto
    {
        return $this->clients->findByEmail($email);
    }

    public function update(int $id, array $data): ?ClientDto
    {
        if (!$this->clients->findById($id)) {
            return null;
        }

        $model = $this->clients->update($id, $data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->clients->findById($id);

        if(!$model) {
            return false;
        }

        return $this->clients->delete($id);
    }

    public function forceDelete(int $id): bool
    {
        $model = $this->clients->findById($id);

        if(!$model) {
            return false;
        }

        return $this->clients->forceDelete($id);
    }

    public function changeManager(int $clientId, int $managerId): ?ClientDto
    {
        $client = $this->clients->findById($clientId);

        if (!$client) {
            return null;
        }

        if (!app(UserService::class)->findById($managerId)) {
            return null;
        }

        return $client;
    }
}

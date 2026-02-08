<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientFilterRequest;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(protected ClientService $service) {}

    public function index(ClientFilterRequest $request)
    {
        return ClientResource::collection($this->service->index($request));
    }

    public function create(CreateClientRequest $request): ClientResource
    {
        return new ClientResource($this->service->create($request->validated()));
    }

    public function findByEmail(UpdateClientRequest $request): ClientResource
    {
        return new ClientResource($this->service->findByEmail($request->validated('email')));
    }

    public function update(int $id, UpdateClientRequest $request): ClientResource
    {
        return new ClientResource($this->service->update($id, $request->validated()));
    }

    public function delete(int $id): bool
    {
        return $this->service->delete($id);
    }

    public function forceDelete(int $id): bool
    {
        return $this->service->forceDelete($id);
    }

    public function changeManager(int $clientId, int $managerId): ClientResource
    {
        return new ClientResource($this->service->changeManager($clientId, $managerId));
    }
}

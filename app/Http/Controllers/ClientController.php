<?php

namespace App\Http\Controllers;

use App\Dto\FilterDto;
use App\Http\Requests\ClientFilterRequest;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    public function __construct(protected ClientService $service) {}

    public function index(ClientFilterRequest $request)
    {
        $dto = FilterDto::fromArray($request->validated());
        return ClientResource::collection($this->service->index($dto));
    }

    public function store(CreateClientRequest $request): ClientResource|JsonResponse
    {
        return new ClientResource($this->service->create($request->validated()));
    }

    public function find(int $id): ClientResource|JsonResponse
    {
        return new ClientResource($this->service->find($id));
    }

    public function findByEmail(UpdateClientRequest $request): ClientResource|JsonResponse
    {
        return new ClientResource($this->service->findByEmail($request->validated('email')));
    }

    public function update(int $id, UpdateClientRequest $request): ClientResource|JsonResponse
    {
        return new ClientResource($this->service->update($id, $request->validated()));
    }

    public function destroy(int $id): bool|JsonResponse
    {
        return $this->service->delete($id);
    }

    public function forceDelete(int $id): bool|JsonResponse
    {
        return $this->service->forceDelete($id);
    }

    public function changeManager(int $clientId, int $managerId): ClientResource|JsonResponse
    {
        return new ClientResource($this->service->changeManager($clientId, $managerId));
    }
}

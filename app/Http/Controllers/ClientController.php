<?php

namespace App\Http\Controllers;

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
        try {
            return ClientResource::collection($this->service->index($request));
        } catch (\Exception $e) {
            return response()->json(['error' => 'index: ' . $e->getMessage()], 500);
        }
    }

    public function store(CreateClientRequest $request): ClientResource|JsonResponse
    {
        try {
            return new ClientResource($this->service->create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'store: ' . $e->getMessage()], 500);
        }
    }

    public function findByEmail(UpdateClientRequest $request): ClientResource|JsonResponse
    {
        try {
            return new ClientResource($this->service->findByEmail($request->validated('email')));
        } catch (\Exception $e) {
            return response()->json(['error' => 'findByEmail: ' . $e->getMessage()], 500);
        }
    }

    public function update(int $id, UpdateClientRequest $request): ClientResource|JsonResponse
    {
        try {
            return new ClientResource($this->service->update($id, $request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'update: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): bool|JsonResponse
    {
        try {
            return $this->service->delete($id);
        } catch (\Exception $e) {
            return response()->json(['error' => 'destroy: ' . $e->getMessage()], 500);
        }
    }

    public function forceDelete(int $id): bool|JsonResponse
    {
        try {
            return $this->service->forceDelete($id);
        } catch (\Exception $e) {
            return response()->json(['error' => 'forceDelete: ' . $e->getMessage()], 500);
        }
    }

    public function changeManager(int $clientId, int $managerId): ClientResource|JsonResponse
    {
        try {
            return new ClientResource($this->service->changeManager($clientId, $managerId));
        } catch (\Exception $e) {
            return response()->json(['error' => 'changeManager: ' . $e->getMessage()], 500);
        }
    }
}

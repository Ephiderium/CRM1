<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDealRequest;
use App\Http\Requests\UpdateDealRequest;
use App\Http\Resources\DealResource;
use App\Services\DealService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function __construct(
        protected DealService $service,
    ) {}

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection|JsonResponse
    {
        try {
            return DealResource::collection($this->service->index());
        } catch (\Exception $e) {
            return response()->json(['error' => 'index: ' . $e->getMessage()], 500);
        }
    }

    public function find(int $id): DealResource|JsonResponse
    {
        try {
            return new DealResource($this->service->findById($id));
        } catch (\Exception $e) {
            return response()->json(['error' => 'find: ' . $e->getMessage()], 500);
        }
    }

    public function findByManager(int $id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection|JsonResponse
    {
        try {
            return DealResource::collection($this->service->findByManager($id));
        } catch (\Exception $e) {
            return response()->json(['error' => 'findByManager: ' . $e->getMessage()], 500);
        }
    }

    public function findByClient(int $id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection|JsonResponse
    {
        try {
            return DealResource::collection($this->service->findByClient($id));
        } catch (\Exception $e) {
            return response()->json(['error' => 'findByClient: ' . $e->getMessage()], 500);
        }
    }

    public function store(CreateDealRequest $request): DealResource|JsonResponse
    {
        try {
            return new DealResource($this->service->create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'store: ' . $e->getMessage()], 500);
        }
    }

    public function update(int $id, UpdateDealRequest $request): DealResource|JsonResponse
    {
        try {
            return new DealResource($this->service->update($id, $request->validated()));
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

    public function changeStage(int $id, UpdateDealRequest $request): DealResource|JsonResponse
    {
        try {
            return new DealResource($this->service->changeStage($id, $request->validated('stage')));
        } catch (\Exception $e) {
            return response()->json(['error' => 'changeStage: ' . $e->getMessage()], 500);
        }
    }

    public function changeAmount(int $id, UpdateDealRequest $request): DealResource|JsonResponse
    {
        try {
            return new DealResource($this->service->changeAmount($id, $request->validated('amount')));
        } catch (\Exception $e) {
            return response()->json(['error' => 'changeAmount: ' . $e->getMessage()], 500);
        }
    }
}

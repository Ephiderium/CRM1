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
        return DealResource::collection($this->service->index());
    }

    public function find(int $id): DealResource|JsonResponse
    {
        return new DealResource($this->service->findById($id));
    }

    public function findByManager(int $id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection|JsonResponse
    {
        return DealResource::collection($this->service->findByManager($id));
    }

    public function findByClient(int $id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection|JsonResponse
    {
        return DealResource::collection($this->service->findByClient($id));
    }

    public function store(CreateDealRequest $request): DealResource|JsonResponse
    {
        return new DealResource($this->service->create($request->validated()));
    }

    public function update(int $id, UpdateDealRequest $request): DealResource|JsonResponse
    {
        return new DealResource($this->service->update($id, $request->validated()));
    }

    public function destroy(int $id): bool|JsonResponse
    {
        return $this->service->delete($id);
    }

    public function changeStage(int $id, UpdateDealRequest $request): DealResource|JsonResponse
    {
        return new DealResource($this->service->changeStage($id, $request->validated('stage')));
    }

    public function changeAmount(int $id, UpdateDealRequest $request): DealResource|JsonResponse
    {
        return new DealResource($this->service->changeAmount($id, $request->validated('amount')));
    }
}

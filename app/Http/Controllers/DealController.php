<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDealRequest;
use App\Http\Requests\UpdateDealRequest;
use App\Http\Resources\DealResource;
use App\Services\DealService;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function __construct(
        protected DealService $service,
    ) {}

    public function index()
    {
        return DealResource::collection($this->service->index());
    }

    public function find(int $id): ?DealResource
    {
        return new DealResource($this->service->findById($id));
    }

    public function findByManager(int $id)
    {
        return DealResource::collection($this->service->findByManager($id));
    }

    public function findByClient(int $id)
    {
        return DealResource::collection($this->service->findByClient($id));
    }

    public function create(CreateDealRequest $request): DealResource
    {
        return new DealResource($this->service->create($request->validated()));
    }

    public function update(int $id, UpdateDealRequest $request): ?DealResource
    {
        $deal = $this->service->findById($id);
        return $deal ? new DealResource($this->service->update($id, $request->validated())) : null;
    }

    public function delete(int $id): bool
    {
        return $this->service->delete($id);
    }

    public function changeStage(int $id, UpdateDealRequest $request): ?DealResource
    {
        $deal = $this->service->findById($id);
        return $deal ? new DealResource($this->service->changeStage($id, $request->validated('stage'))) : null;
    }

    public function changeAmount(int $id, UpdateDealRequest $request): ?DealResource
    {
        $deal = $this->service->findById($id);
        return $deal ? new DealResource($this->service->changeAmount($id, $request->validated('amount'))) : null;
    }
}

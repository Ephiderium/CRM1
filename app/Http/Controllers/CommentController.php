<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(protected CommentService $service) {}

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection|JsonResponse
    {
        return CommentResource::collection($this->service->index());
    }

    public function find(int $id): CommentResource|JsonResponse
    {
        return new CommentResource($this->service->findById($id));
    }

    public function findByUser(int $id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection|JsonResponse
    {
        return CommentResource::collection($this->service->findByUser($id));
    }

    public function store(int $id, string $instance, CreateCommentRequest $request): CommentResource|JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        return new CommentResource($this->service->create($id, $instance, $data));
    }

    public function update(int $id, UpdateCommentRequest $request): CommentResource|JsonResponse|null
    {
        return new CommentResource($this->service->update($id, $request->validated()));
    }

    public function destroy(int $id): bool|JsonResponse
    {
        return $this->service->delete($id);
    }
}

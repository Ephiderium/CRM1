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
        try {
            return CommentResource::collection($this->service->index());
        } catch (\Exception $e) {
            return response()->json(['error' => 'index: ' . $e->getMessage()], 500);
        }
    }

    public function find(int $id): CommentResource|JsonResponse
    {
        try {
            return new CommentResource($this->service->findById($id));
        } catch (\Exception $e) {
            return response()->json(['error' => 'find: ' . $e->getMessage()], 404);
        }
    }

    public function findByUser(int $id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection|JsonResponse
    {
        try {
            return CommentResource::collection($this->service->findByUser($id));
        } catch (\Exception $e) {
            return response()->json(['error' => 'findByUser: ' . $e->getMessage()], 404);
        }
    }

    public function store(int $id, string $instance, CreateCommentRequest $request): CommentResource|JsonResponse
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user();
            return new CommentResource($this->service->create($id, $instance, $data));
        } catch (\Exception $e) {
            return response()->json(['error' => 'store: ' . $e->getMessage()], 422);
        }
    }

    public function update(int $id, UpdateCommentRequest $request): CommentResource|JsonResponse|null
    {
        try {
            return new CommentResource($this->service->update($id, $request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'update: ' . $e->getMessage()], 422);
        }
    }

    public function destroy(int $id): bool|JsonResponse
    {
        try {
            return $this->service->delete($id);
        } catch (\Exception $e) {
            return response()->json(['error' => 'destroy: ' . $e->getMessage()], 404);
        }
    }
}

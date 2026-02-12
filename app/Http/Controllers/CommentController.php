<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(protected CommentService $service) {}

    public function index()
    {
        return CommentResource::collection($this->service->index());
    }

    public function find(int $id): CommentResource
    {
        return new CommentResource($this->service->findById($id));
    }

    public function findByUser(int $id)
    {
        return CommentResource::collection($this->service->findByUser($id));
    }

    public function create(CreateCommentRequest $request): CommentResource
    {
        return new CommentResource($this->service->create($request->validated()));
    }

    public function update(int $id, CreateCommentRequest $request): ?CommentResource
    {
        $comment = $this->service->findById($id);
        return $comment ? new CommentResource($this->service->update($id, $request->validated())) : null;
    }

    public function destroy(int $id): bool
    {
        return $this->service->delete($id);
    }
}

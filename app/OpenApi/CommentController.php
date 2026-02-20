<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    #[OA\Get(
        path: "/api/comment/index",
        security: [["sanctum" => []]],
        summary: "Список комментариев",
        tags: ["comment"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Success",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/Comment")
                )
            ),
            new OA\Response(
                response: 500,
                description: "Error server",
            )
        ]
    )]
    public function index()
    {
        //
    }

    #[OA\Get(
        path: "/api/comment/{id}",
        security: [["sanctum" => []]],
        summary: "Поиск по id",
        tags: ["comment"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id комментария",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Comment resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Comment"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Not found",
            )
        ]
    )]
    public function find(int $id)
    {
        //
    }

    #[OA\Get(
        path: "/api/comment/by-user/{id}",
        security: [["sanctum" => []]],
        summary: "Поиск по id пользователя",
        tags: ["comment"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id пользователя",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Comment resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Comment"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Not found",
            )
        ]
    )]
    public function findByUser(int $id)
    {
        //
    }

    #[OA\Post(
        path: "/api/comment/{id}/{instance}",
        security: [["sanctum" => []]],
        summary: "Создание пользователя",
        tags: ["comment"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id модели",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            ),
            new OA\Parameter(
                name: "instance",
                description: "имя модели. deal/client",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/CreateCommentRequest"
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Comment resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Comment"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function store(int $id, string $instance, CreateCommentRequest $request)
    {
        //
    }

    #[OA\Patch(
        path: "/api/comment/update/{id}",
        security: [["sanctum" => []]],
        summary: "Обновление по id",
        tags: ["comment"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id комментерия",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/UpdateCommentRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "User resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Comment"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function update(int $id, UpdateCommentRequest $request)
    {
        //
    }

    #[OA\Delete(
        path: "/api/comment/{id}",
        security: [["sanctum" => []]],
        summary: "Удаление по id",
        tags: ["comment"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id комментария",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Comment deleted",
            ),
            new OA\Response(
                response: 404,
                description: "Not found",
            )
        ]
    )]
    public function destroy(int $id)
    {
      //
    }
}

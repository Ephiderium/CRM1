<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeRoleRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    #[OA\Post(
        path: "/api/users/change-password",
        security: [["sanctum" => []]],
        summary: "Change password",
        tags: ["users"],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/ResetPasswordRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Change success",
            ),
            new OA\Response(
                response: 500,
                description: "Error server",
            )
        ]
    )]
    public function changePassword(ResetPasswordRequest $request)
    {
        //
    }

    #[OA\Patch(
        path: "/api/users/disable-user",
        security: [["sanctum" => []]],
        summary: "Лишение прав",
        tags: ["users"],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/UpdateUserRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Desable success",
            ),
            new OA\Response(
                response: 404,
                description: "Not found",
            )
        ]
    )]
    public function disableUser(UpdateUserRequest $request)
    {
        //
    }

    #[OA\Patch(
        path: "/api/users/change-role",
        security: [["sanctum" => []]],
        summary: "Смена роли пользователя",
        tags: ["users"],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/ChangeRoleRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Change role success",
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]

    public function changeRole(ChangeRoleRequest $request)
    {
        //
    }

    #[OA\Get(
        path: "/api/users/index",
        security: [["sanctum" => []]],
        summary: "Список пользователей",
        tags: ["users"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Success",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/User")
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
        path: "/api/users/{id}",
        security: [["sanctum" => []]],
        summary: "Поиск по id",
        tags: ["users"],
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
                description: "User resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/User"
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
        path: "/api/users/by-email",
        security: [["sanctum" => []]],
        summary: "Поиск по id",
        tags: ["users"],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/UpdateUserRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "User resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/User"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Not found",
            )
        ]
    )]
    public function findByEmail(UpdateUserRequest $request)
    {
        //
    }

    #[OA\Post(
        path: "/api/users/",
        security: [["sanctum" => []]],
        summary: "Создание пользователя",
        tags: ["users"],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/CreateUserRequest"
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "User resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/User"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function store(CreateUserRequest $request)
    {
        //
    }

    #[OA\Patch(
        path: "/api/update/{id}",
        security: [["sanctum" => []]],
        summary: "Обновление по id",
        tags: ["users"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id пользователя",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/UpdateUserRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "User resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/User"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function update(int $id, UpdateUserRequest $request)
    {
        //
    }

    #[OA\Delete(
        path: "/api/users/{id}",
        security: [["sanctum" => []]],
        summary: "Удаление по id",
        tags: ["users"],
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
                description: "User deleted",
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

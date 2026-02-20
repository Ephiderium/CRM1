<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientFilterRequest;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    #[OA\Get(
        path: "/api/client/index",
        security: [["sanctum" => []]],
        summary: "Список клиентов",
        tags: ["client"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Success",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/Client")
                )
            ),
            new OA\Response(
                response: 500,
                description: "Error server",
            )
        ]
    )]
    public function index(ClientFilterRequest $request)
    {
        //
    }

    #[OA\Post(
        path: "/api/client/",
        security: [["sanctum" => []]],
        summary: "Создание клиента",
        tags: ["client"],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/CreateClientRequest"
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Client resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Client"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function store(CreateClientRequest $request)
    {
        //
    }

    #[OA\Get(
        path: "/api/client/by-email",
        security: [["sanctum" => []]],
        summary: "Поиск по email",
        tags: ["client"],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/UpdateClientRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Client resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Client"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Not found",
            )
        ]
    )]
    public function findByEmail(UpdateClientRequest $request)
    {
        //
    }

    #[OA\Patch(
        path: "/api/client/update/{id}",
        security: [["sanctum" => []]],
        summary: "Обновление по id",
        tags: ["client"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id клиента",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/UpdateClientRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "User resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Client"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function update(int $id, UpdateClientRequest $request)
    {
        //
    }

    #[OA\Delete(
        path: "/api/client/{id}",
        security: [["sanctum" => []]],
        summary: "Удаление по id",
        tags: ["client"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id клиента",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Client deleted",
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

    #[OA\Delete(
        path: "/api/client/force-delete/{id}",
        security: [["sanctum" => []]],
        summary: "Безвозвратное удаление по id",
        tags: ["client"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id клиента",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Client deleted",
            ),
            new OA\Response(
                response: 404,
                description: "Not found",
            )
        ]
    )]
    public function forceDelete(int $id)
    {
        //
    }

    #[OA\Patch(
        path: "/api/client/manager/{id}",
        security: [["sanctum" => []]],
        summary: "Изменение менеджера по id клиента",
        tags: ["client"],
        parameters: [
            new OA\Parameter(
                name: "clientId",
                description: "id клиента",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            ),
            new OA\Parameter(
                name: "managerId",
                description: "id клиента",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Client resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Client"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function changeManager(int $clientId, int $managerId)
    {
        //
    }
}

<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDealRequest;
use App\Http\Requests\UpdateDealRequest;

class DealController extends Controller
{
    #[OA\Get(
        path: "/api/deal/index",
        security: [["sanctum" => []]],
        summary: "Список сделок",
        tags: ["deal"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Success",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/Deal")
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
        path: "/api/deal/{id}",
        security: [["sanctum" => []]],
        summary: "Поиск по id",
        tags: ["deal"],
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
                description: "Deal resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Deal"
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
        path: "/api/deal/by-manager/{id}",
        security: [["sanctum" => []]],
        summary: "Поиск по id менеджера",
        tags: ["deal"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id менеджера",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Success",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/Deal")
                )
            ),
            new OA\Response(
                response: 500,
                description: "Error server",
            )
        ]
    )]
    public function findByManager(int $id)
    {
        //
    }

    #[OA\Get(
        path: "/api/deal/by-client/{id}",
        security: [["sanctum" => []]],
        summary: "Поиск по id клиента",
        tags: ["deal"],
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
                description: "Success",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/Deal")
                )
            ),
            new OA\Response(
                response: 500,
                description: "Error server",
            )
        ]
    )]
    public function findByClient(int $id)
    {
        //
    }

    #[OA\Post(
        path: "/api/deal/",
        security: [["sanctum" => []]],
        summary: "Создание сделки",
        tags: ["deal"],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/CreateDealRequest"
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Deal resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Deal"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function store(CreateDealRequest $request)
    {
        //
    }

    #[OA\Patch(
        path: "/api/deal/update/{id}",
        security: [["sanctum" => []]],
        summary: "Обновление по id",
        tags: ["deal"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id сделки",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/UpdateDealRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "User resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Deal"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function update(int $id, UpdateDealRequest $request)
    {
       //
    }

    #[OA\Delete(
        path: "/api/deal/{id}",
        security: [["sanctum" => []]],
        summary: "Удаление по id",
        tags: ["deal"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id сделки",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Deal deleted",
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

    #[OA\Patch(
        path: "/api/users/stage/{id}'",
        security: [["sanctum" => []]],
        summary: "Изменение стадии сделки",
        tags: ["deal"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id сделки",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/UpdateDealRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Change success",
            ),
            new OA\Response(
                response: 404,
                description: "Not found",
            )
        ]
    )]
    public function changeStage(int $id, UpdateDealRequest $request)
    {
        //
    }

    #[OA\Patch(
        path: "/api/users/amount/{id}'",
        security: [["sanctum" => []]],
        summary: "Изменение суммы сделки",
        tags: ["deal"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id сделки",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/UpdateDealRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Change success",
            ),
            new OA\Response(
                response: 404,
                description: "Not found",
            )
        ]
    )]
    public function changeAmount(int $id, UpdateDealRequest $request)
    {
        //
    }
}

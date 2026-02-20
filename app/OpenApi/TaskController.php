<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    #[OA\Get(
        path: "/api/task/index",
        security: [["sanctum" => []]],
        summary: "Список задач",
        tags: ["task"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Success",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/Task")
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
        path: "/api/task/{id}",
        security: [["sanctum" => []]],
        summary: "Поиск по id",
        tags: ["task"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id задачи",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Task resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Task"
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
        path: "/api/task/by-user/{id}",
        security: [["sanctum" => []]],
        summary: "Поиск по id пользователя",
        tags: ["task"],
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
                description: "Task resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Task"
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
        path: "/api/task/",
        security: [["sanctum" => []]],
        summary: "Создание задачи",
        tags: ["task"],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/CreateUserRequest"
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "User resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Task"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function store(CreateTaskRequest $request)
    {
        //
    }

    #[OA\Patch(
        path: "/api/task/update/{id}",
        security: [["sanctum" => []]],
        summary: "Обновление по id",
        tags: ["task"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id задачи",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/UpdateTaskRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "User resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Task"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function update(int $id, UpdateTaskRequest $request)
    {
       //
    }

    #[OA\Delete(
        path: "/api/task/{id}",
        security: [["sanctum" => []]],
        summary: "Удаление по id",
        tags: ["task"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id задачи",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Task deleted",
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
        path: "/api/task/change-dline/{id}",
        security: [["sanctum" => []]],
        summary: "Смена дедлайна по id",
        tags: ["task"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id задачи",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/UpdateTaskRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "User resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Task"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function changeDeadline(int $id, UpdateTaskRequest $request)
    {
        //
    }

    #[OA\Patch(
        path: "/api/task/status/{id}",
        security: [["sanctum" => []]],
        summary: "Смена статуса по id",
        tags: ["task"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id задачи",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/UpdateTaskRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "User resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Task"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function changeStatus(int $id, UpdateTaskRequest $request)
    {
        //
    }

    #[OA\Patch(
        path: "/api/task/related/{id}",
        security: [["sanctum" => []]],
        summary: "Смена сущности по id",
        description: "Смета сущности по которой определена задача. client\deal",
        tags: ["task"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id задачи",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/UpdateTaskRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "User resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Task"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function changeRelated(int $id, UpdateTaskRequest $request)
    {
       //
    }

    #[OA\Patch(
        path: "/api/task/assigned/{id}",
        security: [["sanctum" => []]],
        summary: "Смена ответственного по id задачи",
        description: "Смета ответственного за задачу",
        tags: ["task"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "id задачи",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/UpdateTaskRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "User resource",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Task"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function changeAssigned(int $id, UpdateTaskRequest $request)
    {
        //
    }
}

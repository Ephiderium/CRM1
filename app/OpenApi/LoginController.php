<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    #[OA\Post(
        path: "/api/login",
        security: [["sanctum" => []]],
        summary: "Вход в систему",
        tags: ["auth"],
        requestBody: new OA\RequestBody(
            ref: "#/components/requestBodies/LoginRequest"
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "token",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "token",
                            type: "string",
                            example: "1|randomlongtokenhereabcdef1234567890",
                            description: "Bearer токен"
                        ),
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: "Error validation",
            )
        ]
    )]
    public function login(LoginRequest $request)
    {
        //
    }

    #[OA\Delete(
        path: "/api/logout",
        summary: "Выход из системы",
        tags: ["auth"],
        security: [["sanctum" => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: "Sucess",
            ),
            new OA\Response(
                response: 500,
                description: "Server error",
            ),
        ]
    )]
    public function logout()
    {
        //
    }
}

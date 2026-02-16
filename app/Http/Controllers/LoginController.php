<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginController extends Controller
{
    public function __construct(
        protected LoginService $service,
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        return response()->json(['token' => $this->service->login($request->validated())]);
    }

    public function logout(): void
    {
        $this->service->logout();
    }
}

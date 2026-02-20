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
        try {
            return response()->json(['token' => $this->service->login($request->validated())]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'error login: ' . $e->getMessage()], 422);
        }
    }

    public function logout()
    {
        try {
            $this->service->logout();
        } catch (\Exception $e) {
            return response()->json(['error' => 'error logout: ' . $e->getMessage()], 500);
        }
    }
}

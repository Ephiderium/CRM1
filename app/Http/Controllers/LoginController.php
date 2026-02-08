<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(
        protected LoginService $service,
    ) {}

    public function login(LoginRequest $request): string
    {
        return $this->service->login($request->validated());
    }

    public function logout(): void
    {
        $this->service->logout();
    }
}

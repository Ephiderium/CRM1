<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function login(array $data): array
    {
        if (!Auth::attempt($data)) {
            throw new \Exception('Ошибка входа');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        return [
            'token' => $user->createToken('default')->plainTextToken,
            'user' => $user
            ];
    }

    public function logout(): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->tokens()->delete();
    }
}

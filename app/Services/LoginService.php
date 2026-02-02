<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function login(array $data): string
    {
        if (!Auth::attempt($data)) {
            return response()->json(['message' => 'Ошибка входа'])->setStatusCode(401);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        return $user->createToken('default')->plainTextToken;
    }

    public function logout(): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->tokens()->delete();
    }
}

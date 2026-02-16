<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('login', function () {
    User::factory()->user('user');
    $response = $this->post('/api/login', [
        'email' => 't@test.com',
        'password' => 'test0000',
    ]);
    $response->assertStatus(200);
});

test('logout', function () {
    $user = User::factory()->user('user');
    $token = $this->post('/api/login', [
        'email' => 't@test.com',
        'password' => 'test0000',
    ]);
    $response = $this->withHeader('Authorization', 'Bearer ' . $token->json('token'))->delete('/api/logout');
    $response->assertStatus(200);
});

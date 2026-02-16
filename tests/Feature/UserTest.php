<?php

use App\Models\Client;
use App\Models\User;

test('createAdmin', function () {
    $user = User::factory()->user('admin');
    $token = $user->createToken('test')->plainTextToken;

    $this->artisan('app:make-admin tt@test.com test10000')
        ->assertExitCode(0);
});

test('changePassword', function () {
    $user = User::factory()->user('admin');
    $token = $user->createToken('test')->plainTextToken;
    $data = [
        'current_password' => 'test0000',
        'password' => 'tyst1111',
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/users/change-password', $data);

    $response->assertStatus(200);
});

test('disableUser', function () {
    $user = User::factory()->user('admin');
    $token = $user->createToken('test')->plainTextToken;
    User::factory()->create(['email' => 's@test.com']);
    $email = ['email' => 's@test.com'];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/users/disable-user', $email);

    $response->assertStatus(200);
});

test('changeRole', function () {
    $user = User::factory()->user('admin');
    $token = $user->createToken('test')->plainTextToken;
    $user = User::factory()->create();
    $email = [
        'email' => $user->email,
        'role' => 'manager'
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/users/change-role', $email);

    $response->assertStatus(200);
});

test('index', function () {
    $user = User::factory()->user('admin');
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/users/index');

    $response->assertStatus(200);
});

test('find', function () {
    $user = User::factory()->user('admin');
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get(uri: '/api/users/1');

    $response->assertStatus(200);
});

test('findByEmail', function () {
    $user = User::factory()->user('admin');
    $token = $user->createToken('test')->plainTextToken;
    $email = ['email' => $user->email];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/users/by-email', $email);

    $response->assertStatus(200);
});

test('store', function () {
    $user = User::factory()->user('admin');
    $token = $user->createToken('test')->plainTextToken;
    $data = [
        'name' => 'testss',
        'email' => 'tt@test.com',
        'password' => '1testw12222',
        'is_active' => true,
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/users/', $data);

    $response->assertStatus(201);
});

test('update', function () {
    $user = User::factory()->user('admin');
    $token = $user->createToken('test')->plainTextToken;
    $data = ['name' => 'name'];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/users/update/1', $data);

    $response->assertStatus(200);
});

test('destroy', function () {
    $user = User::factory()->user('admin');
    User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('/api/users/2');

    $response->assertStatus(200);
});

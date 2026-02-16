<?php

use App\Models\Client;
use App\Models\User;

test('index', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/client/index');

    $response->assertStatus(200);
});

test('create', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    $data = [
        'name' => 'test',
        'email' => 'tttt@test.com',
        'phone' => '+144543534',
        'company' => 'test.co',
        'source' => 'call',
        'manager_id' => '1',
        'status' => 'new'
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/client/', $data);

    $response->assertStatus(201);
});

test('findByEmail', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    Client::factory()->create([
        'email' => 't@test.com',
        'manager_id' => 1,
    ]);
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/client/by-email', ['email' => 't@test.com']);

    $response->assertStatus(200);
});

test('update', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    $data = ['email' => 'tt@test'];
    Client::factory(['manager_id' => 1])->create();
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/client/update/1', $data);

    $response->assertStatus(200);
});

test('destroy', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    Client::factory(['manager_id' => 1])->create();
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('/api/client/1');

    $response->assertStatus(200);
});

test('forceDelete', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    Client::factory(['manager_id' => 1])->create();
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('/api/client/force-delete/1');

    $response->assertStatus(200);
});

test('changeManager', function () {
    $user = User::factory()->user('user');
    User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    Client::factory(['manager_id' => 1])->create();
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/client/manager/1/2');

    $response->assertStatus(200);
});

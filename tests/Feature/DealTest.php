<?php

use App\Models\Client;
use App\Models\Deal;
use App\Models\User;

test('index', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/deal/index');

    $response->assertStatus(200);
});

test('find', function () {
    $user = User::factory()->user('user');
    Client::factory()->create(['manager_id' => 1]);
    Deal::factory()->create([
        'manager_id' => 1,
        'client_id' => 1,
        ]);
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/deal/1');
    $response->assertStatus(200);
});

test('findByManager', function () {
    $user = User::factory()->user('user');
    Client::factory()->create(['manager_id' => 1]);
    Deal::factory()->create([
        'manager_id' => 1,
        'client_id' => 1,
        ]);
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/deal/by-manager/1');
    $response->assertStatus(200);
});

test('findByClient', function () {
    $user = User::factory()->user('user');
    Client::factory()->create(['manager_id' => 1]);
    Deal::factory()->create([
        'manager_id' => 1,
        'client_id' => 1,
        ]);
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/deal/by-client/1');
    $response->assertStatus(200);
});

test('create', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    Client::factory()->create(['manager_id' => 1]);
    $data = [
        'client_id' => 1,
        'manager_id' => 1,
        'amount' => 1111,
        'stage' => 'new',
        'expected_close_date' => '2026-02-16 09:09:24',
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/deal/', $data);

    $response->assertStatus(201);
});

test('update', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    Client::factory()->create(['manager_id' => 1]);
    Deal::factory()->create([
        'manager_id' => 1,
        'client_id' => 1,
        ]);
    $data = ['amount' => 11];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/deal/update/1', $data);

    $response->assertStatus(200);
});

test('destroy', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    Client::factory()->create(['manager_id' => 1]);
    Deal::factory()->create([
        'manager_id' => 1,
        'client_id' => 1,
        ]);
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('/api/deal/1');

    $response->assertStatus(200);
});

test('changeStage', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    Client::factory()->create(['manager_id' => 1]);
    Deal::factory()->create([
        'manager_id' => 1,
        'client_id' => 1,
        ]);
    $data = ['stage' => 'progress'];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/deal/stage/1', $data);

    $response->assertStatus(200);
});

test('changeAmount', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    Client::factory()->create(['manager_id' => 1]);
    Deal::factory()->create([
        'manager_id' => 1,
        'client_id' => 1,
        ]);
    $data = ['amount' => 222];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/deal/amount/1', $data);

    $response->assertStatus(200);
});

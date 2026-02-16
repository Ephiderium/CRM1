<?php

use App\Models\Client;
use App\Models\Task;
use App\Models\User;

test('index', function () {
    $user = User::factory()->user('manager');
    Client::factory(['manager_id' => 1]);
    Task::factory()->create(['assigned_to' => 1]);
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/task/index');

    $response->assertStatus(200);
});

test('find', function () {
    $user = User::factory()->user('manager');
    Client::factory(['manager_id' => 1]);
    Task::factory()->create(['assigned_to' => 1]);
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get(uri: '/api/task/1');

    $response->assertStatus(200);
});

test('findByUser', function () {
    $user = User::factory()->user('manager');
    Client::factory(['manager_id' => 1]);
    Task::factory()->create(['assigned_to' => 1]);
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/task/by-user/1');

    $response->assertStatus(200);
});

test('store', function () {
    $user = User::factory()->user('manager');
    Client::factory(['manager_id' => 1]);
    $data = [
        'title' => 'test',
        'description' => 'testtest',
        'assigned_to' => '1',
        'related_type' => 'client',
        'related_id' => '1',
        'due_date' => '2028-02-01',
        'status' => 'new',
    ];
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/task/', $data);

    $response->assertStatus(201);
});

test('update', function () {
    $user = User::factory()->user('manager');
    Client::factory(['manager_id' => 1]);
    Task::factory()->create(['assigned_to' => 1]);
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/task/update/1', ['title' => 'test']);

    $response->assertStatus(200);
});

test('destroy', function () {
    $user = User::factory()->user('manager');
    Client::factory(['manager_id' => 1]);
    Task::factory()->create(['assigned_to' => 1]);
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('/api/task/1');

    $response->assertStatus(200);
});

test('changeDeadline', function () {
    $user = User::factory()->user('manager');
    Client::factory(['manager_id' => 1]);
    Task::factory()->create(['assigned_to' => 1]);
    $token = $user->createToken('test')->plainTextToken;
    $data = ['due_date' => '2026-02-12'];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/task/change-dline/1', $data);

    $response->assertStatus(200);
});

test('changeStatus', function () {
    $user = User::factory()->user('manager');
    Client::factory(['manager_id' => 1]);
    Task::factory()->create(['assigned_to' => 1]);
    $token = $user->createToken('test')->plainTextToken;
    $data = ['status' => 'new'];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/task/status/1', $data);


    $response->assertStatus(200);
});

test('changeRelated', function () {
    $user = User::factory()->user('manager');
    Client::factory(['manager_id' => 1]);
    Task::factory()->create(['assigned_to' => 1]);
    $token = $user->createToken('test')->plainTextToken;
    $data = [
        'related_type' => 'client',
        'related_id' => 1,
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/task/related/1', $data);

    $response->assertStatus(200);
});

test('changeAssigned', function () {
    $user = User::factory()->user('manager');
    Client::factory(['manager_id' => 1]);
    Task::factory()->create(['assigned_to' => 1]);
    $token = $user->createToken('test')->plainTextToken;
    $data = [
        'assigned_to' => 1,
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/task/assigned/1', $data);

    $response->assertStatus(200);
});

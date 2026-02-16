<?php

use App\Models\Client;
use App\Models\Comment;
use App\Models\User;

test('index', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/comment/index');

    $response->assertStatus(200);
});

test('find', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    $client = Client::factory()->create(['manager_id' => 1]);
    Comment::factory()->for($client, 'commentable')->create(['user_id' => 1]);
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/comment/1');

    $response->assertStatus(200);
});

test('findByUser', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    $client = Client::factory()->create(['manager_id' => 1]);
    Comment::factory()->for($client, 'commentable')->create(['user_id' => 1]);
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/comment/by-user/1');

    $response->assertStatus(200);
});

test('create', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    Client::factory()->create(['manager_id' => 1]);
    $data = [
        'user_id' => 1,
        'body' => 'test body',
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/comment/1/client', $data);

    $response->assertStatus(200);
});

test('update', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    Client::factory()->create(['manager_id' => 1]);
    $data = [
        'user_id' => 1,
        'body' => 'test body',
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/comment/1/client', $data);
    $dataComment = ['body' => 'update body'];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/comment/update/1', $dataComment);

    $response->assertStatus(200);
});

test('destroy', function () {
    $user = User::factory()->user('user');
    $token = $user->createToken('test')->plainTextToken;
    Client::factory()->create(['manager_id' => 1]);
    $data = [
        'user_id' => 1,
        'body' => 'test body',
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/comment/1/client', $data);
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('/api/comment/1');

    $response->assertStatus(200);
});

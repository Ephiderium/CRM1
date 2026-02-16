<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Comment;
use App\Models\Deal;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);

        $users = User::factory()
        ->count(5)
        ->create()
        ->each->assignRole('admin');

        $users->each(function ($user) {
            Client::factory()
                ->count(40)
                ->for($user, 'manager')
                ->afterCreating(function (Client $client) {
                    Comment::factory([
                        'commentable_id' => $client->id,
                        'commentable_type' => 'client',
                    ])
                    ->count(2)
                    ->create();
                })
                ->create();

            Deal::factory()
                ->count(10)
                ->for($user, 'manager')
                ->afterCreating(function (Deal $deal) {
                    Comment::factory([
                        'commentable_id' => $deal->id,
                        'commentable_type' => 'deal',
                    ])
                    ->count(2)
                    ->for($deal, 'commentable')
                    ->create();
                })
                ->create();

            Task::factory()
                ->count(7)
                ->for($user, 'assignedTo')
                ->create();
        });
    }
}

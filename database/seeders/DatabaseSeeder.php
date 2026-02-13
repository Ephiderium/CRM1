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
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'clients.view',
            'clients.edit',
            'deals.view',
            'deals.edit',
            'tasks.manage',
            'users.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $admin = Role::findOrCreate('admin', 'web');
        $admin->syncPermissions($permissions);

        $manager = Role::findOrCreate('manager', 'web');
        $manager->syncPermissions([
            'clients.view',
            'clients.edit',
            'deals.view',
            'deals.edit',
            'tasks.manage',
        ]);

        $user = Role::findOrCreate('user', 'web');
        $user->syncPermissions([
            'clients.view',
            'clients.edit',
            'deals.view',
            'deals.edit',
        ]);

        $viewer = Role::findOrCreate('viewer', 'web');
        $viewer->syncPermissions([
            'clients.view',
            'deals.view',
        ]);

        $users = User::factory()
        ->count(5)
        ->create()
        ->each->assignRole('admin');

        $users->each(function ($user) {
            Client::factory()
                ->count(40)
                ->for($user, 'manager')
                ->afterCreating(function (Client $client) {
                    Comment::factory()
                    ->count(2)
                    ->for($client, 'commentable')
                    ->create();
                })
                ->create();

            Deal::factory()
                ->count(10)
                ->for($user, 'manager')
                ->afterCreating(function (Deal $deal) {
                    Comment::factory()
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

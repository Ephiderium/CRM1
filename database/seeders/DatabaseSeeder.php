<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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

        foreach ($permissions as $permision) {
            Permission::findOrCreate($permision, 'web');
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
    }
}

<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
    }
}

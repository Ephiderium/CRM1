<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    public static function findOrCreate(string $name, string $guardName): ?Role
    {
        if (!self::where('name', $name)->first()) {
            $model = self::create([
                'name' => $name,
                'guard_name' => $guardName,
            ]);

            return $model;
        } else {
            return null;
        }
    }

    public function syncPermissions(array $permissions): void
    {
        foreach ($permissions as $permission) {
            $id = Permission::where('name', $permission)->first()->id;
            $this->permissions()->attach($id);
        }
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions');
    }
}

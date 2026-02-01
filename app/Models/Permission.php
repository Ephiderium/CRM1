<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    public static function findOrCreate(string $name, string $guardName): ?Permission
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

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions');
    }
}

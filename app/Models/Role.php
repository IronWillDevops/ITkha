<?php

namespace App\Models;

use App\Exceptions\Role\CannotDeleteProtectedRoleException;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['title'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    protected static function booted(): void
    {
        static::deleting(function (Role $role) {
            if (in_array($role->id, [1, 2, 3])) {
                throw new CannotDeleteProtectedRoleException();
            }
        });
    }
}

<?php

namespace App\Models;

use App\Exceptions\Role\CannotDeleteProtectedRoleException;
use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use LogsActivity;
    protected $fillable = ['title', 'description'];

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
    //Slug 
    public function getRouteKeyName(): string
    {
        return 'title';
    }

    public function isProtected(): bool
    {
        return in_array($this->id, config('roles.protected_ids'), true);
    }
}

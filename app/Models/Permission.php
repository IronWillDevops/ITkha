<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
   protected $fillable = ['header', 'key'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}

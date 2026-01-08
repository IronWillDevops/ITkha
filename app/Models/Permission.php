<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use LogsActivity;
    protected $fillable = ['header', 'key'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}

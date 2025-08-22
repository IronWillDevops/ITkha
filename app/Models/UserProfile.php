<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'job_title',
        'address',
        'about_myself',
        'github',
        'linkedin',
        'website',
    ];

    public function user()
    {

        return $this->belongsTo(User::class);
    }
}

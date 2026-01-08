<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use LogsActivity;
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

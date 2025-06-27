<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'model_type',
        'model_id',
        'event',
        'changes',
        'description',
        'user_email',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected $casts = [
        'changes' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

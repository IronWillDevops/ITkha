<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolicyTranslation extends Model
{
    protected $fillable = ['locale', 'title', 'content'];

    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }
}

<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class FooterLink extends Model
{
    use LogsActivity;
    protected $fillable = ['icon', 'title', 'url'];
}

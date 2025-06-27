<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
     use SoftDeletes, HasFactory;
     protected $fillable = ['name', 'subject', 'email', 'message','is_read'];
}

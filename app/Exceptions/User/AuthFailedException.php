<?php

namespace App\Exceptions\User;

use Exception;

class AuthFailedException extends Exception
{
    protected $message = "These credentials do not match our records.";
}

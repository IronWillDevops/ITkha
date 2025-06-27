<?php

namespace App\Exceptions\User;

use Exception;

class EmailNotVerifiedException extends Exception
{
     protected $message = 'Email address is not verified.';
}

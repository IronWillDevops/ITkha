<?php

namespace App\Exceptions\User;

use Exception;

class AccountInactiveException extends Exception
{
     protected $message = 'This account is not active or blocked';
}

<?php

namespace App\Exceptions\User;

use Exception;

class CannotDeactivateLastActiveUserException extends Exception
{
    protected $message = "It is not possible to deactivate the last active user.";
}



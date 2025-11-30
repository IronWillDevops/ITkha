<?php

namespace App\Exceptions\User;

use Exception;

class CannotDeactivateLastActiveUserException extends Exception
{
    public function __construct()
    {
        parent::__construct(__('errors/user.deactivate.last_active'));
    }
}

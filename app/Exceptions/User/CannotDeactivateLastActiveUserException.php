<?php

namespace App\Exceptions\User;

use Exception;

class CannotDeactivateLastActiveUserException extends Exception
{
    public function __construct()
    {
        parent::__construct(__('common/exceptions.user.CannotDeactivateLastActiveUserException'));
    }
}

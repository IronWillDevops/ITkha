<?php

namespace App\Exceptions\Role;

use Exception;

class CannotDeleteProtectedRoleException extends Exception
{
     public function __construct()
    {
        parent::__construct(__('common/exceptions.role.CannotDeleteProtectedRoleException'));
    }
}
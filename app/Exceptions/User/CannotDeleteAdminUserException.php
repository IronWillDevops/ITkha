<?php

namespace App\Exceptions\User;

use Exception;

class CannotDeleteAdminUserException extends Exception
{
     public function __construct()
     {
          parent::__construct(__('exception/user.CannotDeleteAdminUserException'));
     }
}

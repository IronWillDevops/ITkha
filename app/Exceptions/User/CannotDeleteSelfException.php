<?php

namespace App\Exceptions\User;

use Exception;

class CannotDeleteSelfException extends Exception
{    public function __construct()
     {
          parent::__construct(__('errors/user.delete.self'));
     }
}

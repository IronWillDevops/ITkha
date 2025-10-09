<?php

namespace App\Exceptions\User;

use Exception;

class EmailNotVerifiedException extends Exception
{
        public function __construct()
     {
          parent::__construct(__('exception/user.EmailNotVerifiedException'));
     }
}

<?php

namespace App\Exceptions\Role;

use Exception;

class CannotDeleteProtectedRoleException extends Exception
{
      protected $message ="Deleting system roles is prohibited.";
}

<?php

namespace App\Exceptions\Role;

use Exception;

class CannotUpdateProtectedRoleException extends Exception
{
    protected $message = "Editing system roles is prohibited.";
    //
}

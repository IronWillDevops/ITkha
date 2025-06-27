<?php

namespace App\Exceptions\User;

use Exception;

class CannotDeleteAdminUserException extends Exception
{
     protected $message = "Deleting a user from this account is prohibited.";
}

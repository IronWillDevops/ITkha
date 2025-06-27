<?php

namespace App\Exceptions\User;

use Exception;

class CannotDeleteSelfException extends Exception
{
     protected $message = 'Deleting yourself is prohibited.';
}

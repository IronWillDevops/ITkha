<?php

namespace App\Exceptions\Category;

use Exception;

class CannotDeleteLastCategoryException extends Exception
{
    protected $message = "Deleting the last category is prohibited.";
}

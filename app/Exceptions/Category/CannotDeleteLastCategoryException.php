<?php

namespace App\Exceptions\Category;

use Exception;

class CannotDeleteLastCategoryException extends Exception
{
    public function __construct()
    {
        parent::__construct(__('exception/category.CannotDeleteLastCategoryException'));
    }
}

<?php

namespace App\Exceptions\Category;

use Exception;

class CannotDeleteCategoryWithPostsException extends Exception
{
    public function __construct()
    {
        parent::__construct(__('common/exceptions.category.CannotDeleteCategoryWithPostsException'));
    }
}

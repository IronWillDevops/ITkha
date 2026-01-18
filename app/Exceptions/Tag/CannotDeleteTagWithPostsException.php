<?php

namespace App\Exceptions\Tag;

use Exception;

class CannotDeleteTagWithPostsException extends Exception
{
    public function __construct()
    {
        parent::__construct(__('errors/tag.delete.has_posts'));
    }
}

<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Foundation\Events\Dispatchable;

class PostPublished
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(public Post $post)
    {
        
    }


}

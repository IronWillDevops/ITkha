<?php

namespace App\Http\Controllers\Admin\Posts\Post;

use App\Http\Controllers\Controller;
use App\Services\Admin\PostService;

class BaseController extends Controller
{
  public $service;
  public function __construct(PostService $service)
  {
    
    $this->service = $service;
  }
}

<?php

namespace App\Http\Controllers\Public\Comment;

use App\Http\Controllers\Controller;
use App\Services\Public\CommentService;

class BaseController extends Controller
{
  public $service;
  public function __construct(CommentService $service)
  {
    $this->service = $service;
  }
}

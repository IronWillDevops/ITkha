<?php

namespace App\Http\Controllers\Admin\SocialLink;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Social\UpdateRequest;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(UpdateRequest $request, SocialLink $link )
  {

    $data = $request->validated();
    $link->update($data);
    return view('admin.pages.social.show', compact('link')); // Можно заменить на вашу главную страницу

  }
}

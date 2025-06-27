<?php

namespace App\Http\Controllers\Admin\SocialLink;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SocialLink $link)
    {
     $link->delete();
       return redirect()->route('admin.settings.social.index')->with('toast', [
                'type' => 'success', // success | info | warning | danger
                'title' => 'Success',
                'message' =>'Social successfully deleted',
            ]);
    }
}

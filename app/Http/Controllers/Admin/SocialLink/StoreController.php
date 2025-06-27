<?php

namespace App\Http\Controllers\Admin\SocialLink;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Social\StoreRequest;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        SocialLink::firstOrCreate($data);

        return redirect()->route('admin.settings.social.index'); // Можно заменить на вашу главную страницу
    }
}

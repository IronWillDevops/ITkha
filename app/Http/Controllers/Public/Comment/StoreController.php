<?php

namespace App\Http\Controllers\Public\Comment;


use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Comment\StoreRequest;
use Faker\Provider\Base;

class StoreController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {

        $data = $request->validated();
        
        $this->service->handle($request->validated());

        return redirect()->back();
    }
}

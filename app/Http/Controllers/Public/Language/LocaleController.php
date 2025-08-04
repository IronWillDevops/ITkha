<?php

namespace App\Http\Controllers\Public\Language;



class LocaleController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $locale)
    {
        $this->service->store($locale);
        return redirect()->back();
    }
}

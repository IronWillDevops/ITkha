<?php

namespace App\Http\Controllers\Admin\Log;

use App\Models\Log;

class IndexController
{
    public function __invoke()
    {
        
        $logs = Log::orderBy('id', 'desc')->paginate(25);
        return view('admin.pages.log.index', compact('logs'));
    }
}

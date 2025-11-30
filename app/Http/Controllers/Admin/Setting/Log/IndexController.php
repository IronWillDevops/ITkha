<?php

namespace App\Http\Controllers\Admin\Setting\Log;

use App\Models\Log;

class IndexController
{
    public function __invoke()
    {
        
        $logs = Log::orderBy('id', 'desc')->paginate(35);
        return view('admin.setting.log.index', compact('logs'));
    }
}

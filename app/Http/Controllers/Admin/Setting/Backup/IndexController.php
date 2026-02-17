<?php

namespace App\Http\Controllers\Admin\Setting\Backup;

use App\Http\Controllers\Controller;
use App\Services\Admin\BackupService;

class IndexController extends Controller
{
    public function __invoke(BackupService $backupService)
    {
        $backups = $backupService->listBackups();

        return view('admin.setting.backup.index', compact('backups'));
    }
}
<?php

namespace App\Http\Controllers\Admin\Setting\Backup;

use App\Http\Controllers\Controller;
use App\Services\Admin\BackupService;
use Illuminate\Http\RedirectResponse;

class CreateController extends Controller
{
    public function __invoke(BackupService $backupService): RedirectResponse
    {
        try {
            $backupService->createBackup();

            return redirect()
                ->route('admin.setting.backup.index')->with('success', __('admin/settings/backup.messages.created'));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.setting.backup.index')
                ->with('error', __('errors/backup.create.failed'));
        }
    }
}

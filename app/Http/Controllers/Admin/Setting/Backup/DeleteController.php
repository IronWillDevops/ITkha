<?php

namespace App\Http\Controllers\Admin\Setting\Backup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\Backup\DeleteRequest;
use App\Services\Admin\BackupService;
use Illuminate\Http\RedirectResponse;

class DeleteController extends Controller
{
    public function __invoke(DeleteRequest $request, BackupService $backupService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $filename = $data['filename'];
            $backupService->deleteBackup($filename);

            return redirect()
                ->route('admin.setting.backup.index')
                ->with('success', __('admin/settings/backup.messages.deleted', ['filename' => $filename]));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.setting.backup.index')
                ->with('error', __('errors/backup.delete.failed'));
        }
    }
}

<?php

namespace  App\Http\Controllers\Admin\Setting\Backup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\Backup\RestoreRequest;
use App\Services\Admin\BackupService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RestoreController extends Controller
{
    public function __invoke(RestoreRequest $request, BackupService $backupService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $filename = $data['filename'];
            $backupService->restoreBackup($filename);

            return redirect()
                ->route('admin.setting.backup.index')
                ->with('success', __('admin/settings/backup.messages.restored', ['filename' => $filename]));
        } catch (\Exception $ex) {

            logger()->error('Backup restore failed', ['exception' => $ex]);
            return redirect()
                ->route('admin.setting.backup.index')
                ->with('error', __('errors/backup.restore.failed'));
        }
    }
}

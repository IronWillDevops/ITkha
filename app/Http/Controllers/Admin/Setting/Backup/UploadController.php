<?php

namespace App\Http\Controllers\Admin\Setting\Backup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\Backup\UploadRequest;
use App\Services\Admin\BackupService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UploadRequest $request, BackupService $backupService)
    {

        try {
            $data = $request->validated();
            $file = $data['filename'];
            $backupService->uploadBackup($file);

            return redirect()
                ->route('admin.setting.backup.index')
                ->with('success', __('admin/settings/backup.messages.uploaded'));
        } catch (\Exception $e) {
            Log::error('Backup upload failed: ' . $e->getMessage());

            return redirect()
                ->route('admin.setting.backup.index')
                ->with('error', __('errors/backup.upload.failed'));
        }
    }
}

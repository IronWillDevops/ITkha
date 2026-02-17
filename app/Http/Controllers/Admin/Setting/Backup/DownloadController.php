<?php

namespace App\Http\Controllers\Admin\Setting\Backup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\Backup\DownloadRequest;
use App\Services\Admin\BackupService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadController extends Controller
{
    public function __invoke(DownloadRequest $request, BackupService $backupService): BinaryFileResponse
    {

        try {
            $data = $request->validated();
            $filename = $data['filename'];
            $filePath = $backupService->downloadBackup($filename);

            return response()->download($filePath);
        } catch (\Exception $e) {
            abort(404, $e->getMessage());
        }
    }
}

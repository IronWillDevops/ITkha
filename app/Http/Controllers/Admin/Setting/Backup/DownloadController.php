<?php

namespace App\Http\Controllers\Admin\Setting\Backup;

use App\Http\Controllers\Controller;
use App\Services\Admin\BackupService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadController extends Controller
{
    public function __invoke(Request $request, BackupService $backupService): BinaryFileResponse
    {
        $request->validate([
            'filename' => 'required|string',
        ]);

        try {
            $filePath = $backupService->downloadBackup($request->filename);

            return response()->download($filePath);
        } catch (\Exception $e) {
            abort(404, $e->getMessage());
        }
    }
}
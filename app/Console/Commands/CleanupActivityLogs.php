<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use Illuminate\Console\Command;

class CleanupActivityLogs extends Command
{
   protected $signature = 'activity-logs:cleanup';
    protected $description = 'Delete activity logs older than 7 days';

    public function handle(): int
    {
        $deleted = ActivityLog::where('created_at', '<', now()->subDays(7))->delete();

        $this->info("Deleted {$deleted} activity logs older than 7 days.");

        return self::SUCCESS;
    }
}

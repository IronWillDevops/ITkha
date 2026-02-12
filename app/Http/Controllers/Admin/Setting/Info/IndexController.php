<?php

namespace App\Http\Controllers\Admin\Setting\Info;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Support\ByteFormatter;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Config;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $info = Cache::remember('server_dashboard_info', 30, function () {
            return [
                'php' => [
                    'version' => PHP_VERSION,
                    'memory_limit' => ini_get('memory_limit'),
                    'max_execution_time' => ini_get('max_execution_time') . ' sec',
                    'upload_max_filesize' => ini_get('upload_max_filesize'),
                    'extensions' => get_loaded_extensions(),
                ],
                'laravel' => [
                    'version' => App::version(),
                    'env' => config('app.env'),
                    'debug' => config('app.debug') ? 'ON' : 'OFF',
                    'locale' => config('app.locale'),
                    'url' => config('app.url'),
                    'cache_driver' => Config::get('cache.default'),
                    'queue_driver' => Config::get('queue.default'),
                    'session_driver' => Config::get('session.driver'),
                ],
                'composer' => $this->getComposerPackages(),
                'system' => [
                    'os' => php_uname(),
                    'uptime' => $this->getUptime(),
                    'cpu_cores' => $this->getCpuCores(),
                    'load_average' => function_exists('sys_getloadavg') ? sys_getloadavg() : null,
                    'memory_usage' => ByteFormatter::format(memory_get_usage(true)),
                    'memory_peak' => ByteFormatter::format(memory_get_peak_usage(true)),
                    'disk_free' => ByteFormatter::format(disk_free_space('/') ?: 0),
                    'disk_total' => ByteFormatter::format(disk_total_space('/') ?: 0),
                ],
                'services' => [
                    'database' => $this->getDatabaseStatus(),
                    'redis' => $this->getRedisStatus(),
                ],
                'time' => [
                    'php_now' => now()->toDateTimeString(),
                    'system_timezone' => date_default_timezone_get(),
                    'server_addr' => $_SERVER['SERVER_ADDR'] ?? 'N/A',
                ],
            ];
        });

        return view('admin.setting.info.index', compact('info'));
    }

 

    protected function getCpuCores()
    {
        if (is_file('/proc/cpuinfo')) {
            return substr_count(file_get_contents('/proc/cpuinfo'), 'processor');
        }
        return 'N/A';
    }

    protected function getUptime()
    {
        try {
            if (function_exists('shell_exec')) {
                $out = @shell_exec('uptime -p 2>/dev/null');
                if ($out) return trim($out);
            }
        } catch (\Throwable $e) {
        }
        return 'N/A';
    }

    protected function getDatabaseStatus()
    {
        try {
            $connection = DB::connection();
            $pdo = $connection->getPdo();
            $driver = $connection->getName();
            $version = $pdo->getAttribute(\PDO::ATTR_SERVER_VERSION);
            return "{$driver} (v{$version})";
        } catch (\Throwable $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    protected function getRedisStatus()
    {
        try {
            $pong = Redis::ping();
            return $pong === true || $pong === 'PONG' ? 'OK' : 'Fail';
        } catch (\Throwable $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    protected function getComposerPackages()
    {
        $file = base_path('composer.lock');
        if (!file_exists($file)) return [];
        $data = json_decode(file_get_contents($file), true);
        return collect($data['packages'] ?? [])->mapWithKeys(function ($p) {
            return [$p['name'] => $p['version']];
        })->toArray();
    }
}

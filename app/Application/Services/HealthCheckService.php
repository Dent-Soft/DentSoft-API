<?php

namespace App\Application\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HealthCheckService
{
    public function check(): array
    {
        $startTime = microtime(true);

        return [
            'app'               => $this->checkApp(),
            'database'          => $this->checkDatabase(),
            'cache'             => $this->checkCache(),
            'storage'           => $this->checkStorage(),
            'queues'            => $this->checkQueue(),
            'external_services' => $this->checkExternalServices(),
            'meta'              => $this->checkMeta($startTime),
        ];
    }

    private function checkApp(): array
    {
        return [
            'status'          => 'ok',
            'env'             => config('app.env'),
            'debug'           => config('app.debug'),
            'php_version'     => PHP_VERSION,
            'laravel_version' => app()->version(),
            'server_time'     => now()->toIso8601String(),
        ];
    }

    private function checkDatabase(): array
    {
        try {
            DB::connection()->getPdo();
            return [ 'status' => 'ok', 'database' => config('database.default') ];
        } catch (\Exception $e) {
            return [ 'status' => 'error', 'message' => $e->getMessage() ];
        }
    }

    private function checkCache(): array
    {
        try {
            Cache::put('health_check', 'ok', 10);
            return [ 'status' => 'ok', 'driver' => config('cache.default') ];
        } catch (\Exception $e) {
            return [ 'status' => 'error', 'message' => $e->getMessage() ];
        }
    }

    private function checkStorage(): array
    {
        try {
            Storage::put('health_check.txt', 'ok');
            Storage::delete('health_check.txt');
            return [ 'status' => 'ok', 'disk' => config('filesystems.default') ];
        } catch (\Exception $e) {
            return [ 'status' => 'error', 'message' => $e->getMessage() ];
        }
    }

    private function checkQueue(): array
    {
        try {
            $failedJobs = Artisan::call('queue:failed');
            return [ 'status' => 'ok', 'queue_driver' => config('queue.default'), 'failed_jobs' => $failedJobs ];
        } catch (\Exception $e) {
            return [ 'status' => 'error', 'message' => $e->getMessage() ];
        }
    }

    private function checkExternalServices(): array
    {
        return [
            'stripe' => [ 'status' => 'unknown' ]
        ];
    }

    private function checkMeta(float $startTime): array
    {
        return [
            'execution_time' => round(microtime(true) - $startTime, 4) . ' sec',
            'memory_usage'   => round(memory_get_usage(true) / 1024 / 1024, 2) . ' MB',
        ];
    }
}

<?php

namespace App\Interface\Http\Controllers;

use App\Application\Services\HealthCheckService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class HealthCheckController extends Controller
{
    public function __construct(private readonly HealthCheckService $healthCheckService)
    {
    }

    public function check(): JsonResponse
    {
        return response()->json($this->healthCheckService->check());
    }
}

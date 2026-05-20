<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceCheckMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Admin/staff yang sudah login tidak terkena maintenance
        if (Auth::check() && Auth::user()->hasMinRole('staff')) {
            return $next($request);
        }

        // Cek status dari DB — cache 1 menit agar responsif saat toggle
        $isActive = Cache::remember('maintenance_active', 60, function () {
            return Maintenance::where('is_active', true)->exists();
        });

        if ($isActive) {
            $maintenance  = Cache::remember('maintenance_data', 60, fn() =>
                Maintenance::where('is_active', true)->latest()->first()
            );

            $countdown_to = $maintenance?->countdown_to?->toIso8601String();
            $message      = $maintenance?->message ?? 'Website sedang dalam maintenance. Mohon tunggu.';

            return response()->view('errors.503', compact('countdown_to', 'message'), 503);
        }

        return $next($request);
    }
}

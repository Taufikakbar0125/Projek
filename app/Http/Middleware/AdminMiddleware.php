<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next, string $minRole = 'staff'): Response
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = auth()->user();
        $roles = ['super_admin' => 3, 'admin' => 2, 'staff' => 1];
        $userLevel = $roles[$user->role] ?? 0;
        $requiredLevel = $roles[$minRole] ?? 1;

        if ($userLevel < $requiredLevel) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
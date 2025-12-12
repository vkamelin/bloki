<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Admin;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if admin is authenticated
        if (!auth()->guard('dashboard')->check()) {
            return redirect()->route('dashboard.login');
        }

        /** @var Admin $admin */
        $admin = auth()->guard('dashboard')->user();

        // If no roles specified, just check if authenticated
        if (empty($roles)) {
            return $next($request);
        }

        // Check if admin has any of the required roles
        foreach ($roles as $role) {
            if ($admin->hasRole($role)) {
                return $next($request);
            }
        }

        // If we get here, admin doesn't have required role
        abort(403, 'Недостаточно прав для выполнения этого действия.');
    }
}
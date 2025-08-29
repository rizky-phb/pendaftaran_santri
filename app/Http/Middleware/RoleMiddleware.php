<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            // Belum login → redirect ke login page filament user
            return redirect()->route('filament.user.auth.login');
        }

        $userRole = strtolower(auth()->user()->role);

        // Superadmin → akses semua
        if ($userRole === 'superadmin') {
            return $next($request);
        }

        // Admin hanya boleh akses route /admin/*
        if ($userRole === 'admin' && $request->is('admin/*')) {
            return $next($request);
        }

        // User hanya boleh akses route /user/*
        if ($userRole === 'user' && $request->is('user/*')) {
            return $next($request);
        }

        // Kalau role tidak sesuai, redirect ke dashboard masing-masing
        switch ($userRole) {
            case 'admin':
                return redirect('/admin');
            case 'user':
                return redirect('/user');
            case 'superadmin':
                return redirect('/superadmin');
            default:
                abort(403, 'Unauthorized');
        }
    }
}

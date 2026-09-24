<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user()->load('employee.role');

        if (!$user->employee) {
            abort(403, 'Akun belum terhubung ke data employee. Hubungi HR.');
        }

        $userRoleTitle = trim((string) ($user->employee?->role?->title ?? ''));

        if ($userRoleTitle === '') {
            abort(403, 'Role tidak ditemukan untuk akun ini. Hubungi HR.');
        }

        $roles = array_map(fn ($role) => strtolower(trim($role)), $roles);

        if (!in_array(strtolower($userRoleTitle), $roles)) {
            abort(403, 'Unauthorized - your role: ' . $userRoleTitle);
        }

        return $next($request);
    }
}

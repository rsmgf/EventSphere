<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roleuser): Response
    {
        if (!Auth::check()) {
        return redirect()->route('login');
    }
        $user = Auth::user();

    if ($user->role === $roleuser) {
        return $next($request);
    }

    if ($user->role === 'admin') {
        return redirect()->route('admin.home')->with('status', 'Anda tidak memiliki akses ke halaman ini.');
    } elseif ($user->role === 'user') {
        return redirect()->route('user.home')->with('status', 'Anda tidak memiliki akses ke halaman ini.');
    }

    return redirect()->route('home');
    }
}

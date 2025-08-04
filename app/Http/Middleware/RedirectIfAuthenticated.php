<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                if ($user->role === 'admin') {
                    return redirect('/admin/dashboard');
                } elseif ($user->role === 'ketua_bidang') {
                    return redirect()->route('kabid.dashboard');
                } elseif ($user->role === 'pegawai') {
                    return redirect()->route('anggota.dashboard');
                } elseif ($user->role === 'warga') {
                    return redirect('warga/dashboard');
                } else {
                    return redirect('/');
                }
            }
        }
        return $next($request);
    }
}

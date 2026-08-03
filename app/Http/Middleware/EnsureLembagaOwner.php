<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureLembagaOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            $subdomain = $request->route('lembaga');
            return redirect()->route('lembaga.login', ['lembaga' => $subdomain]);
        }

        // Superadmin boleh mengakses semua lembaga
        if (auth()->user()->isSuperadmin()) {
            return $next($request);
        }

        // Admin lembaga hanya boleh akses lembaga miliknya
        $subdomain = $request->route('lembaga');
        $lembaga = \App\Models\Lembaga::where('subdomain', $subdomain)->first();

        if (!$lembaga || auth()->user()->id !== $lembaga->user_id) {
            abort(403, 'Akses ditolak. Anda bukan pengelola lembaga ini.');
        }

        return $next($request);
    }
}

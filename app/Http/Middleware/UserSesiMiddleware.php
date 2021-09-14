<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserSesiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session('sesi')==null)
            return redirect()->route('user.choose.tahun.anggaran');

        return $next($request);
    }
}
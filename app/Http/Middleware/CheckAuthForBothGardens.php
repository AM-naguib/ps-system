<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthForBothGardens
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth('web')->check() && !auth('worker')->check()) {
            return redirect()->route('login.index'); // لو مش مسجل دخول هيرجع لصفحة اللوجين
        }

        return $next($request);
    }
}

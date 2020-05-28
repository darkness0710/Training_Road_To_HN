<?php

namespace App\Http\Middleware;

use Closure;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isBannedUntil && now()->lessThan(auth()->user()->isBannedUntil)) {
            $banned_days = now()->diffInDays(auth()->user()->isBannedUntil);
            auth()->logout();
            $message = 'Your account has been suspended for ' . $banned_days . ' day(s). Please contact administrator.';
            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}

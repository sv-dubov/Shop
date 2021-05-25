<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Administrator
{
    public function handle($request, Closure $next, $guard = null) {
        if ( ! auth()->user()->admin) {
            abort(404);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        abort_unless((int) $request->user()->role_id === 1, 403);

        return $next($request);
    }
}

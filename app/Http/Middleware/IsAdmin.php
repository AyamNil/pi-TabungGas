<?php

namespace App\Http\Middleware\IsAdmin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return $next($request);
        }
        return redirect('/');
    }
}


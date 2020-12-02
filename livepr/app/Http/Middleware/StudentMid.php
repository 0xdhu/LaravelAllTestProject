<?php

namespace App\Http\Middleware;

use Closure;

class StudentMid
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
        echo "<h1>Test</h1>";
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class TestFirst
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
        echo '<pre>';
        echo 'in TestFirst Middleware!!!!!!!!!!!!!!!';
        return $next($request);
    }
}

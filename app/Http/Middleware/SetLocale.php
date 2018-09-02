<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Application\App;
use Closure;

class SetLocale
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
    echo 'locale : <br />';
    print_r(App); 
    return $next($request);
  }
}

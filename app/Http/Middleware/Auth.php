<?php

namespace App\Http\Middleware;

use Closure;

class Auth
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
    $request->merge([
      '__params' => [
        'menuId' => 'Cruise',
        'menus' => [
          ['name' => 'Order', 'displayName' => '訂單系統'],
          ['name' => 'Cruise', 'displayName' => '船班設定'],
        ],
        'subMenus' => [
          ['name' => 'routeList', 'displayName' => '航班總覽', 'url' => '/cruise/routeList'],
          ['name' => 'editDest', 'displayName' => '航點設定', 'url' => '/cruise/editDest'],
          ['name' => 'editRoute', 'displayName' => '航線設定', 'url' => '/cruise/editRoute'],
        ],
      ],
    ]);

    return $next($request);
  }
}

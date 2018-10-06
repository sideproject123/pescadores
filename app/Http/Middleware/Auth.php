<?php

namespace App\Http\Middleware;

use App;
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
    preg_match('/([a-zA-Z]+)(?:\/)([a-zA-Z]+)?/', $request->path(), $matches);

    $menuId = $matches[1];
    $subMenuId = $matches[2];
    $menus = [
      'cruise' => [
        'displayName' => '船班設定',
        'url' => '',
        'subMenus' => [
          'routeList' => [
            'displayName' => '航班總覽',
            'url' => '/cruise/routeList',
          ],
          'editDest' => [
            'displayName' => '航點設定',
            'url' => '/cruise/editDest',
          ],
          'editRoute' => [
            'displayName' => '航線設定',
            'url' => '/cruise/editRoute',
          ],
        ],
      ],
      'order' => [
        'displayName' => '訂單系統',
        'url' => '',
        'subMenus' => [
          'orderList' => [
            'displayName' => '訂單列表',
            'url' => '/order/orderList',
          ],
          'editOrder' => [
            'displayName' => '編輯訂單',
            'url' => '/order/editOrder',
          ],
        ],
      ],
    ];

    if (
      !isset($menus[$menuId])
      || !isset($menus[$menuId]['subMenus'][$subMenuId])
    ) {
      return response('', 403);
    }

    $request->merge([
      '__params' => [
        'menuId' => $menuId,
        'menus' => $menus,
        'subMenus' => $menus[$menuId]['subMenus'],
      ],
    ]);

    return $next($request);
  }
}

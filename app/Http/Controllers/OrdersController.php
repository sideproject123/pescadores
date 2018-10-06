<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Routes;
use App\SeatTypes;
use App\Http\Controllers\RoutesController; 
use Illuminate\Http\Request;

class OrdersController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function show(Orders $orders)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function edit($oId = '', Request $request, Orders $orders)
  {
    $order = [
      'toRoute' => [
        'datetime' => '',
      ]
    ];

    if (empty($order['toRoute']['datetime'])) {
      $order['toRoute']['datetime'] = date('Y-m-d H:i:s');
    }

    $order['toRoute']['date'] = substr($order['toRoute']['datetime'], 0, 10);
    $order['toRoute']['time'] = substr($order['toRoute']['datetime'], 11);

    $rc = new RoutesController();
    $request->merge([
      'd' => $order['toRoute']['date'],
    ]);
    $toRouteOptions = [];
    $routes = $rc->getRoutes($request);

    foreach ($routes as $r) {
      $time = substr($r->datetime, 11, 5);
      $toRouteOptions[] = [
        'value' => $r->id,
        'displayName' => $r->fromName . ' 到 ' . $r->toName . ' ' .  $time . ' (商務艙:' . $r->bSeats . ' 經濟艙:' . $r->eSeats . ')',
      ];
    }

    $params = $request->__params;
    $params['order'] = $order;
    $params['toRouteOptions'] = $toRouteOptions;
    $params['seatTypes'] = SeatTypes::where('status', '=', 'active')->get();

    return view('control_panel_orders_edit_order', $params);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Orders $orders)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function destroy(Orders $orders)
  {
    //
  }
}

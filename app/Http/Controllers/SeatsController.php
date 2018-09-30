<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use App\Routes;
use App\Seats;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Ferries;

class SeatsController extends Controller
{
  public function changeReserveStatus(Request $request, Seats $seats)
  {
    $validator = Validator::make($request->all(), [
      'rId' => 'required|digits_between:1,10',
      'action' => 'required|in:reserve,unreserve',
      'seats' => 'required|Array',
    ]);

    if ($validator->fails()) {
      return response($validator->errors()->first(), 422);
    }

    try {
      DB::beginTransaction();

      $s = $seats
            ->where('route_id', $request->rId)
            ->whereIn('position', $request->seats)
            ->whereIn('status', ['vacant', 'reserved'])
            ->lockForUpdate();

      if (count($request->seats) !== $s->count()) {
        throw new Exception('座位衝突');
      }

      $bClassNum = 0;
      $eClassNum = 0;

      foreach ($s->get() as $item) {
        switch ($item->class) {
          case 'E':
            $eClassNum += 1;
            break;
          case 'B':
            $bClassNum += 1;
            break;
        }
      }

      $r = Routes::find($request->rId);

      if ($request->action === 'reserve') {
        $seatUpdate = ['status' => 'reserved'];
        $routeUpdate = [
          'class_b_seats' => max($r->class_b_seats - $bClassNum, 0),
          'class_e_seats' => max($r->class_e_seats - $eClassNum, 0),
        ];
      } else {
        $seatUpdate = ['status' => 'vacant'];
        $routeUpdate = [
          'class_b_seats' => min($r->class_b_seats + $bClassNum, 65535),
          'class_e_seats' => min($r->class_e_seats + $eClassNum, 65535),
        ];
      }

      $s->update($seatUpdate);
      $r->update($routeUpdate);

      DB::commit();
    } catch (Exception $e) {
      DB::rollBack();
      return response($e->getMessage(), 422);
    }
  }

  static function getSeatsByFields($fields = [], $assocKey = false)
  {
    if (empty($fields)) {
      return [];
    }

    $seats = Seats::where($fields)->get();

    if ($assocKey) {
      $_seats = [];
      
      foreach ($seats as $s) {
        $_seats[$s['position']] = $s;
      } 

      return $_seats;
    }

    return $seats;
  }

  public function layout(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'rId' => 'required|digits_between:1,10',
      'fId' => 'required|digits_between:1,3',
    ]);

    if ($validator->fails()) {
      return response($validator->errors()->first(), 422);
    }

    try {
      $seatInfo = json_decode(Ferries::findOrFail($request->fId)->seat_info, true);
    } catch (ModelNotFoundException $e) {
      return response($e->getMessage(), 422);
    }

    if (!$seatInfo) {
      return response('empty seat info', 500);
    }

    $viewTpl = 'shared.cruise.seat_layout_' . $seatInfo['layout'];

    if (!view()->exists($viewTpl)) {
      return response('view does not exists', 500);
    }

    $params = $request->__params;
    $params['routeId'] = $request->rId;
    $params['seatInfo'] = $seatInfo;
    $params['seats'] = SeatsController::getSeatsByFields(['route_id' => $request->rId], true);

    return view($viewTpl, $params);
  }

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
   * @param  \App\Seats  $seats
   * @return \Illuminate\Http\Response
   */
  public function show(Seats $seats)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Seats  $seats
   * @return \Illuminate\Http\Response
   */
  public function edit(Seats $seats)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Seats  $seats
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Seats $seats)
  {
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Seats  $seats
   * @return \Illuminate\Http\Response
   */
  public function destroy(Seats $seats)
  {
    //
  }

}

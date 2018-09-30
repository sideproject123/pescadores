<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use App\Destinations;
use App\Ferries;
use App\Routes;
use App\Seats;
use App\Http\Controllers\FerriesController; 
use App\Http\Controllers\UtilController; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoutesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return $this->getAll();
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

  public function validation($request)
  {
    $validator = Validator::make($request->all(), [
      'rId' => 'digits_between:1,10',
      'from' => 'required|digits_between:1,3',
      'to' => 'required|digits_between:1,3',
      'fId' => 'required|digits_between:1,3',
      'dt' => 'required|date_format:"Y-m-d H:i:s"',
    ]);

    if ($validator->fails()) {
      $e = $validator->errors()->first();
      throw new Exception($e);
    }

    if ($request->from === $request->to) {
      throw new Exception('from and to are the same');
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Routes $routes)
  {
    try {
      $this->validation($request);
    } catch (Exception $e) {
      return response($e->getMessage(), 422);
    }

    try {
      DB::beginTransaction();

      /*
      $t = [
        'from' => null,
        'to' => 1,
        'dt' => 'abcd',
        'fId' => 1,
      ];
      $r = $routes->firstOrCreate([
        'from_destination_id' => $t['from'],
        'to_destination_id' => $t['to'],
        'datetime' => $t['dt'],
        'ferry_id' => $t['fId'],
      ]);
      */

      $r = $routes->firstOrCreate([
        'from_destination_id' => $request->from,
        'to_destination_id' => $request->to,
        'datetime' => $request->dt,
        'ferry_id' => $request->fId,
      ]);

      // $info = $this->createSeats(1, 1);
      $info = $this->createSeats($request->fId, $r->id);

      if (!$info) {
        throw new Exception();
      }

      $r->update([
        'class_b_seats' => $info['businessVacantNum'],
        'class_e_seats' => $info['economicVacantNum'],
      ]);

      DB::commit();

      return UtilController::resultResponse($r);
    } catch (Exception $e) {
      DB::rollBack();
      $msg = 'create route & seats error: ' . $e->getMessage();
      Log::error($msg);
      return response('database error', 422);
    }
  }

  public function _createSeats(Request $request)
  {
    if (!$this->createSeats($request->fId, $request->rId)) {
      return response('create seats error', 422);
    }

    $s = Seats::where('position', '1J')
      ->orWhere('position', '1K')
      ->orWhere('position', '2J')
      ->orWhere('position', '2K')
      ->orWhere('position', '9J')
      ->orWhere('position', '9K')
      ->update(['status' => 'taken']);
  }

  private function createSeats($ferryId = null, $routeId = null)
  {
    if (!$ferryId || !$routeId) {
      return false; 
    }

    $info = FerriesController::parseSeatInfo($ferryId);

    if (empty($info)) {
      return false;
    }

    $seats = [];

    foreach ($info['seats'] as $pos => $desc) {
      $item = [
        'route_id' => $routeId,
        'position' => $pos,
        'area' => $desc['area'],
        'class' => $desc['class'],
        'status' => $desc['status'],
        'row' => (int)substr($pos, 0, -1),
        'col' => substr($pos, -1),
      ];

      $seats[] = $item;
    }

    try {
      Seats::insert($seats); 
    } catch (Exception $e) {
      return true;
    }

    return $info;
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Routes  $routes
   * @return \Illuminate\Http\Response
   */
  public function show(Routes $routes)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Routes  $routes
   * @return view
   */
  public function edit(Request $request, Routes $routes)
  {
    $params = $request->__params;
    $params['destinations'] = Destinations::select('*', 'id as value', 'name as displayName')
                              ->where(['status' => 1])
                              ->get();
    $params['ferries'] = Ferries::select('*', 'id as value', 'name as displayName')->get();
    $rId = $request->rId;
    $route = $rId ? Routes::find($rId) : [];
    $params['route'] = $route;

    return view('control_panel_cruise_edit_route', $params);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Routes  $routes
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Routes $routes)
  {
    try {
      $this->validation($request);

      $r = $routes->findOrFail($request->rId);
      $r->update([
        'from_destination_id' => $request->from,
        'to_destination_id' => $request->to,
        'datetime' => $request->dt,
        'ferry_id' => $request->fId,
      ]);

      return UtilController::resultResponse($r);
    } catch (Exception $e) {
      return response($e->getMessage(), 422);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Routes  $routes
   * @return \Illuminate\Http\Response
   */
  public function destroy($id, Routes $routes)
  {
    try {
      // check if any ticket sold throw error
      $routes->destroy($id);
      Seats::where('route_id', $id)->delete();

      return response('', 200);
    } catch (Exception $e) {
      return response($e->getMessage(), 422);
    }
  }

  public function updateStatus(Request $request, Routes $routes)
  {
    try {
      $validator = Validator::make($request->all(), [
        'id' => 'required|digits_between:1,10',
        'status' => 'required|in:pending,active,cancelled,completed',
      ]);

      if ($validator->fails()) {
        $e = $validator->errors()->first();
        throw new Exception($e);
      }

      $r = $routes->findOrFail($request->id);
      
      switch ($request->status) {
        case 'cancelled':
          // cancel ticket
          // refund if credit card
          // clear seats
          break;
        default:
          break;
      }

      $r->update([
        'status' => $request->status,
      ]);


    } catch (Exception $e) {
      return response($e->getMessage(), 422);
    }
  }

  public function getAll()
  {
    return Routes::all();
  }

  public function result()
  {
    $resultType = request()->withResult;

    if ($resultType) {
      $all = $this->getAll();

      switch ($resultType) {
        case 'data':
        default:
          return response()->json($all);
      }
    }

    return '';
  }

  public function list(Request $request)
  {
    $params = $request->__params;
    $params['routes'] = DB::table('routes') 
              ->join('destinations as d1', 'routes.from_destination_id', '=', 'd1.id')
              ->join('destinations as d2', 'routes.to_destination_id', '=', 'd2.id')
              ->join('ferries', 'routes.ferry_id', '=', 'ferries.id')
              ->select(
                'routes.id',
                'routes.status',
                'd1.name as fromName',
                'd2.name as toName',
                'datetime',
                'ferries.name as ferryName',
                'ferries.id as ferryId'
              )
              ->orderBy('updated_at', 'desc')
              ->get();
    $params['statusMap'] = Routes::$statusMap;

    return view('control_panel_cruise_route_list', $params);
  }
}

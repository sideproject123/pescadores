<?php

namespace App\Http\Controllers;

use App\Routes;
use Illuminate\Http\Request;
use Validator;
use Exception;
use App\Http\Controllers\UtilController; 

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

    $r = $routes->firstOrCreate([
      'fromDestinationId' => $request->from,
      'toDestinationId' => $request->to,
      'datetime' => $request->dt,
      'ferryId' => $request->fId,
    ]);

    return UtilController::resultResponse($r);
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
   * @param  \App\Routes  $routes
   * @return \Illuminate\Http\Response
   */
  public function edit(Routes $routes)
  {
    //
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
        'fromDestinationId' => $request->from,
        'toDestinationId' => $request->to,
        'datetime' => $request->dt,
        'ferryId' => $request->fId,
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

      return $routes->destroy($id);

      // clear seats
    } catch (Exception $e) {
      return response('', 422);
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
      $r->update([
        'status' => $request->status,
      ]);

      switch ($request->status) {
        case 'cancelled':
          // cancel ticket
          // refund if credit card
          // clear seats
          break;
        default:
          break;
      }


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
}

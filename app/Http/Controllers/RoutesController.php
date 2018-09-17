<?php

namespace App\Http\Controllers;

use App\Routes;
use Illuminate\Http\Request;
use Validator;

class RoutesController extends Controller
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
    $validator = Validator::make($request->all(), [
      'from' => 'required|digits_between:1,3',
      'to' => 'required|digits_between:1,3',
      'fId' => 'required|digits_between:1,3',
      'fId' => 'required|digits_between:1,3',
      'dt' => 'required|date_format:"Y-m-d H:i:s"',
    ]);

    if ($validator->fails()) {
      $e = $validator->errors()->first();
      return response($e, 422);
    }

    if ($request->from === $request->to) {
      return response('from and to are the same', 422);
    }

    Routes::firstOrCreate([
      'fromDestinationId' => $request->from,
      'toDestinationId' => $request->to,
      'datetime' => $request->dt,
      'ferryId' => $request->fId,
    ]);

    if ($request->withResult) {
      $all = Routes::all();

      switch ($request->withResult) {
        case 'data':
        default:
          return response()->json($all);
      }
    }

    return '';
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
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Routes  $routes
   * @return \Illuminate\Http\Response
   */
  public function destroy(Routes $routes)
  {
    //
  }
}

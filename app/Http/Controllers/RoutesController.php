<?php

namespace App\Http\Controllers;

use App\Routes;
use Exception;
use Illuminate\Http\Request;

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
   * validate parameters before inserting a new record.
   * @param  \Illuminate\Http\Request  $request
   * @return boolean
   */
  public function validation($request)
  {
    if (
      !$request->from
      || !$request->to
      || !$request->fId
      || !$request->datetime
      || $request->from === $request->to
    ) {
      return false;
    }

    if (!preg_match('/^[\d]{4}-[\d]{2}-[\d]{2} [\d]{2}:[\d]{2}:[\d]{2}$/', $request->datetime)) {
      return false;
    }

    return true;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if (!$this->validation($request)) {
      return response('', 400);
    }

    try {
      if ($request->id) {
        echo 'wtf';
      } else {
        Routes::firstOrCreate([
          'fromDestinationId' => $request->from,
          'toDestinationId' => $request->to,
          'datetime' => $request->datetime,
          'ferryId' => $request->fId,
        ]);
      }

      if ($request->withResult) {
        $all = Routes::all();

        switch ($request->withResult) {
          case 'table':
            return view('cruise.routes_table', ['data' => $all]);
          case 'data':
            return response()->json($all);
        }
      }

      return '';
    } catch (QueryException $e) {
      // return $e->errorInfo;
      // return $e->errorInfo;
      return '';
    }
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

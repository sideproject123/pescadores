<?php

namespace App\Http\Controllers;

use App\Destinations;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;

class DestinationsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return response()->json(['data' => $this->getAll()]);
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
  public function store(Request $request, Destinations $destinations)
  {
    try {
      $destinations->name = $request->name;
      $destinations->save();
        
      if ($request->withResult) {
        $all = $destinations->all();

        switch ($request->withResult) {
          case 'table':
            return view('cruise.destinations_table', ['data' => $all]);
          case 'data':
            return response()->json($all);
        }
      }

      return '';
    } catch (QueryException $e) {
      return $e->errorInfo;
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Destinations  $destinations
   * @return \Illuminate\Http\Response
   */
  public function show(Destinations $destinations)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Destinations  $destinations
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, Destinations $destinations)
  {
    $params = $request->__params;
    $params['data'] = Destinations::all();
    $params['cols'] = array(
      array('title' => '名稱', 'field' => 'name'),
      array('title' => '', 'field' => 'status')
    );

    return view('control_panel_cruise_edit_dest', $params);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Destinations  $destinations
   * @return \Illuminate\Http\Response
   */
  public function update($id, Request $request, Destinations $destinations)
  {
    try {
      $d = $destinations->find($id);

      switch ($request->value) {
        case '1':
          $s = 1;
          break;
        case '0':
          $s = 0;
          break;
      }

      if (!isset($s)) {
        return response('', 400);
      }

      $d->status = $s;
      $d->save();
    } catch (QueryException $e) {
      return $e->errorInfo;
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Destinations  $destinations
   * @return \Illuminate\Http\Response
   */
  public function destroy(Destinations $destinations)
  {
      //
  }

  public function getAll()
  {
    return Destinations::all();
  }
}

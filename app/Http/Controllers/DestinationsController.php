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
    /*
    $destinations->name = $request->name;
    $destinations->status = 1;
    try {
      $destinations->save();
    } catch (QueryException $e) {
      return $e->errorInfo;
    }
    */
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
   * @param  \App\Destinations  $destinations
   * @return \Illuminate\Http\Response
   */
  public function edit(Destinations $destinations)
  {
      //
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

      switch ($request->action) {
        case 'enable':
          $s = 1;
          break;
        case 'disable':
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
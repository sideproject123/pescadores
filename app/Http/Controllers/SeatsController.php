<?php

namespace App\Http\Controllers;

use App\Seats;
use Illuminate\Http\Request;

class SeatsController extends Controller
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
    //
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

  static function getSeatsByFields($fields = [])
  {
    $seats = [];

    if (empty($fields)) {
      return $seats;
    }

    return Seats::where($fields);
  }
}

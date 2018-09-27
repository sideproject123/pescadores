<?php

namespace App\Http\Controllers;

use App\Ferries;
use Illuminate\Http\Request;
use Exception;

class FerriesController extends Controller
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
   * @param  \App\Ferries  $ferries
   * @return \Illuminate\Http\Response
   */
  public function show(Ferries $ferries)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Ferries  $ferries
   * @return \Illuminate\Http\Response
   */
  public function edit(Ferries $ferries)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Ferries  $ferries
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Ferries $ferries)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Ferries  $ferries
   * @return \Illuminate\Http\Response
   */
  public function destroy(Ferries $ferries)
  {
    //
  }

  public function createArrayFromRange($range = '')
  {
    $a = [];

    if (empty($range)) {
      return $a;
    }

    list($from, $to) = explode('-', $range);

    if (!$from || !$to) {
      return $a; 
    }
    /*
    var_dump($from);
    var_dump($to);

    $fromNum = (int)substr($from, 0, -1);
    $fromChar = (int)(substr($from, -1));

    var_dump($fromNum);
    var_dump($fromChar);
    */
    var_dump(range($from, $to));
  }

  public function createSeatsByRouteId($id = 1) {
    echo '<pre>';
    $seatInfo = json_decode(Ferries::find($id)->seatInfo, 'true');

    if (!$seatInfo) {
      return;
    }

    print_r($seatInfo);

    // $this->createArrayFromRange($seatInfo['reserved'][0]);
    $this->createArrayFromRange('2A-2P');
  }
}

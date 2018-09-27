<?php

namespace App\Http\Controllers;

use App\Ferries;
use Illuminate\Http\Request;
use Exception;

class FerriesController extends Controller
{
  public function createArrayFromRange($range = '', $map)
  {
    $a = [];

    if (!$range || empty($map)) {
      return $a;
    }

    $list = explode('-', $range);

    if (count($list) < 2) {
      return $a;
    }

    $base = count($map);

    foreach ($list as $pos) {
      $co = (int)substr($pos, 0, -1);
      $n = array_search(substr($pos, -1), $map);

      $a[] = $co * $base + $n;
    }

    $ret = [];

    var_dump($list);
    var_dump($a);
    /*
    for ($i = 0, $j = count($a) - 1; $i < $j; ++$i) {
      $tmp = [];

      for ($x = $a[$i], $y = $a[$i + 1]; $x <= $y; ++$x) {
        $q = floor($x / $base);
        $r = $x % $base;
        $tmp[] = $q . $map[$r];
      } 

      $ret[] = $tmp;
    }

    return  count($ret) === 1 ? $ret[0] : $ret;
    */
  }

  public function insertSeatsWithRouteId($id = 1) {
    echo '<pre>';
    $seatInfo = json_decode(Ferries::find($id)->seatInfo, 'true');

    if (!$seatInfo) {
      return;
    }

    print_r($seatInfo);

    $seats = [];
    list($a, $b) = explode('-', $seatInfo['cols']);
    $cols = range($a, $b);

    var_dump($cols);
    // var_dump($this->createArrayFromRange($seatInfo['attributes']['class']['B'][1], $cols));
    var_dump($this->createArrayFromRange($seatInfo['attributes']['class']['B'][0], $cols));
    foreach ($seatInfo['attributes'] as $attr => $item) {
      foreach ($item as $key => $rangeList) {
        foreach ($rangeList as $range) {
          /*
          var_dump($range);
          foreach ($this->createArrayFromRange($range, $cols) as $pos) {
            if (!isset($seats[$pos])) {
              $seats[$pos] = [];
            }

            $seats[$pos] = ['status' => 'reserved'];
          }
          */
        }
      }
    }

    var_dump($seats);
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
}

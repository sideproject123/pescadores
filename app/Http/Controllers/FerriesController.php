<?php

namespace App\Http\Controllers;

use Exception;
use App\Ferries;
use Illuminate\Http\Request;

class FerriesController extends Controller
{
  static function createArrayFromRange($range = '', $map)
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

    for ($i = 0, $j = count($a) - 1; $i < $j; ++$i) {
      $tmp = [];

      for ($x = $a[$i], $y = $a[$i + 1]; $x <= $y; ++$x) {
        $q = floor($x / $base);
        $r = $x % $base;
        $tmp[] = $q . $map[$r];
      } 

      $ret[] = $tmp;
    }

    return count($ret) === 1 ? $ret[0] : $ret;
  }

  static function parseSeatInfo($id = null)
  {
    if (!$id) {
      return;
    }

    $ferry = Ferries::find($id);

    if (!$ferry) {
      return;
    }

    $seatInfo = json_decode($ferry->seatInfo, true);

    if (!$seatInfo) {
      return;
    }

    $seats = [];
    list($a, $b) = explode('-', $seatInfo['cols']);
    $cols = range($a, $b);

    foreach ($seatInfo['attributes'] as $attr => $item) {
      foreach ($item as $key => $rangeList) {
        foreach ($rangeList as $range) {
          foreach (FerriesController::createArrayFromRange($range, $cols) as $pos) {
            if (!isset($seats[$pos])) {
              $seats[$pos] = [];
            }

            $seats[$pos][$attr] = $key;
          }
        }
      }
    }

    $ignore = [];

    if (!empty($seatInfo['ignore'])) {
      foreach ($seatInfo['ignore'] as $range) {
        $ignore = array_merge($ignore, FerriesController::createArrayFromRange($range, $cols));
      }

      $ignore = array_flip($ignore);
    }

    $businVacantNum = 0;
    $ecoVavantNum = 0;

    for ($i = 1, $j = $seatInfo['rows']; $i <= $j; ++$i) {
      foreach ($cols as $c) {
        $pos = $i . $c;

        if (isset($ignore[$pos])) {
          unset($seats[$pos]);
          continue;
        }

        if (!isset($seats[$pos])) {
          $seats[$pos] = [
            'class' => 'E',
            'status' => 'vacant',
          ];

          $ecoVavantNum += 1;
        } else {
          if (!isset($seats[$pos]['class'])) {
            $seats[$pos]['class'] = 'E';
          }

          if (!isset($seats[$pos]['status'])) {
            $seats[$pos]['status'] = 'vacant';
          }

          if (!isset($seats[$pos]['area'])) {
            $seats[$pos]['area'] = 'lower';
          } 

          if ($seats[$pos]['status'] === 'vacant') {
            $cls = $seats[$pos]['class'];

            if ($cls === 'B') {
              $businVacantNum += 1;
            } else if ($cls === 'E') {
              $ecoVavantNum += 1;
            }
          }
        }
      } 
    }

    $seatInfo['seats'] = $seats;
    $seatInfo['businessNum'] = $businVacantNum;
    $seatInfo['economicNum'] = $ecoVavantNum;

    return $seatInfo;
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

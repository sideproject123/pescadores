<?php

namespace App\Http\Controllers;

use App\Destinations;
use Illuminate\Http\Request;

class DestinationsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Destinations $destinations)
  {
    return response()->json(['data' => $this->getAll($destinations)]);
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
    echo 'wtf';
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Destination  $destination
   * @return \Illuminate\Http\Response
   */
  public function show(Destination $destination)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Destination  $destination
   * @return \Illuminate\Http\Response
   */
  public function edit(Destination $destination)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Destination  $destination
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Destination $destination)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Destination  $destination
   * @return \Illuminate\Http\Response
   */
  public function destroy(Destination $destination)
  {
      //
  }

  public function getAll(Destinations $destinations)
  {
    return $destinations->all();
  }
}

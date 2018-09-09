<?php

namespace App\Http\Controllers;

use App\Ferry;
use Illuminate\Http\Request;

class FerryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request, Ferry $ferry)
  {
    print_r($request->all());
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Ferry  $ferry
   * @return \Illuminate\Http\Response
   */
  public function show(Ferry $ferry)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Ferry  $ferry
   * @return \Illuminate\Http\Response
   */
  public function edit(Ferry $ferry)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Ferry  $ferry
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Ferry $ferry)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Ferry  $ferry
   * @return \Illuminate\Http\Response
   */
  public function destroy(Ferry $ferry)
  {
      //
  }
}

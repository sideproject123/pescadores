<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth'])->group(function () {
  Route::group(['prefix' => 'cruise'], function () {
    Route::get('editDest', 'DestinationsController@edit');
    Route::get('editRoute/{rId?}', 'RoutesController@edit');
    Route::get('routeList', 'RoutesController@list');
    // Route::get('seatLayout/{rId}/', 'SeatsController@layout');
  });

  Route::group(['prefix' => 'order'], function () {
    Route::get('editOrder/{oId?}', 'OrdersController@edit');
  });
});


// testing routes
Route::get('createSeats', 'RoutesController@_createSeats');

/*

Route::group(['middleware' => ['test'], 'namespace' => 'Admin'], function () {
  Route::get('/admin', 'Ship');
});
*/

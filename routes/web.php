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
    Route::get('seatLayout/{rId}/', 'SeatsController@layout');
  });
});


// testing routes
// Route::get('createSeat', 'RoutesController@store');

/*
Route::get('/', function () {
  $all = '{
    "functions": [
      {
        "name": "order",
        "displayName": "訂單系統"
      },
      {
        "name": "ferry",
        "displayName": "船班設定"
      }
    ]
  }';

  $obj = json_decode($all);
  return view('order', ['functions' => $obj->functions]);
});

Route::group(['middleware' => ['test'], 'namespace' => 'Admin'], function () {
  Route::get('/admin', 'Ship');
});
*/

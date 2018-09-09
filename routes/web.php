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

Route::get('/dbtest', 'DBTest@show');

Route::group(['prefix' => 'ferry'], function () {
  $json = '{
    "functionId": "Ferry",
    "functions": [
      {
        "name": "Order",
        "displayName": "訂單系統"
      },
      {
        "name": "Ferry",
        "displayName": "船班設定"
      }
    ],
    "subFunctions": [
      {
        "name": "edit",
        "displayName": "航點 \/ 航段 設定"
      }
    ]
  }';

  $obj = json_decode($json);
  $params = [
    'functions' => $obj->functions,
    'functionId' => $obj->functionId,
    'subFunctions' => $obj->subFunctions,
  ];

  Route::get('edit', function () use ($params) {
    return view('control_panel_ferry_edit', $params);
  });
});

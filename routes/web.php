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
  return view('landing', [
    'title' => 'from subview',
    'msg' => 'hello world'
  ]);
});

Route::get('/dbtest', 'DBTest@show');

Route::get('/phpinfo', function () {
  phpinfo();
});

// Route::get('/admin', 'Admin');

Route::group(['middleware' => ['test'], 'namespace' => 'Admin'], function () {
  Route::get('/admin', 'Ship');
});

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DBTest extends Controller
{
  public function show() {
    $users = DB::select('select * from user');
    echo '<pre>';
    print_r($users);
    return view('dbtest', [
      'users' => $users
    ]);
  }
}

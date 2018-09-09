<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Ship extends Controller
{
  public function __invoke(Request $request) {
    echo 'hello world <br />';
    print_r($request);
  }
}

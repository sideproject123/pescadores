<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControlPanelView extends Controller
{
  public function show() {
    return view('order', [
      'title' => 'abc',
    ]);
  }
}

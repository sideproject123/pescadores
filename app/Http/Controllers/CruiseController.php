<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DestinationsController;

class CruiseController extends Controller
{
  public function editDest(Request $request)
  {
    $json = '{
      "functions": [
        {
          "name": "Order",
          "displayName": "訂單系統"
        },
        {
          "name": "Cruise",
          "displayName": "船班設定"
        }
      ],
      "function": {
        "id": "Cruise",
        "subFunctions": [
          {
            "name": "edit_dest",
            "displayName": "航點設定"
          },
          {
            "name": "edit_route",
            "displayName": "航線設定"
          }
        ]
      }
    }';

    $dest = new DestinationsController();
    $params = json_decode($json, true);
    $params['data'] = $dest->getAll();
    $params['cols'] = array(
      array('title' => '名稱', 'field' => 'name'),
      array('title' => '', 'field' => 'status')
    );
    /*
    echo '<pre>';
    // print_r($params);
    print_r(json_encode($dest->getAll()));
    */

    return view('control_panel_cruise_edit_dest', $params);
  }
}

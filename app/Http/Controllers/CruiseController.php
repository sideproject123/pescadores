<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DestinationsController;
use App\Destinations;
use App\Ferries;
use App\Routes;

class CruiseController extends Controller
{
  public function __construct()
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
            "name": "list_routes",
            "displayName": "航班總覽"
          },
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

    $this->params = json_decode($json, true);
  }

  public function editRoute(Request $request)
  {
    $params = $this->params;
    $dests = Destinations::all();

    foreach ($dests as $item) {
      $item->value = $item->id;
      $item->displayName = $item->name;
    }

    $params['destinations'] = $dests;

    $ferries = Ferries::all();

    foreach ($ferries as $item) {
      $item->value = $item->id;
      $item->displayName = $item->name;
    }

    $params['ferries'] = $ferries;

    return view('control_panel_cruise_edit_route', $params);
  }

  public function editDest(Request $request)
  {
    $params = $this->params;
    $params['data'] = Destinations::all();
    $params['cols'] = array(
      array('title' => '名稱', 'field' => 'name'),
      array('title' => '', 'field' => 'status')
    );

    return view('control_panel_cruise_edit_dest', $params);
  }

  public function routeList(Request $request)
  {
    $params = $this->params;
    $params['routes'] = Routes::all();

    return view('control_panel_cruise_list_routes', $params);
  }
}

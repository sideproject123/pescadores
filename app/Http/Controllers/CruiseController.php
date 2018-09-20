<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\RoutesController;
use App\Destinations;
use App\Ferries;
use App\Routes;
use stdClass;

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
            "url": "/cruise/routeList",
            "name": "routeList",
            "displayName": "航班總覽"
          },
          {
            "url": "/cruise/editDest",
            "name": "editDest",
            "displayName": "航點設定"
          },
          {
            "url": "/cruise/editRoute",
            "name": "editRoute",
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

    $dests = Destinations::select('*', 'id as value', 'name as displayName')->get();

    $params['destinations'] = $dests;

    $ferries = Ferries::select('*', 'id as value', 'name as displayName')->get();

    $params['ferries'] = $ferries;

    $rId = $request->rId;

    $route = $rId ? Routes::find($rId) : [];

    $params['route'] = $route;

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

    $routes = DB::table('routes') 
                ->join('destinations as d1', 'routes.fromDestinationId', '=', 'd1.id')
                ->join('destinations as d2', 'routes.toDestinationId', '=', 'd2.id')
                ->join('ferries', 'routes.ferryId', '=', 'ferries.id')
                ->select(
                  'routes.id',
                  'routes.status',
                  'd1.name as fromName',
                  'd2.name as toName',
                  'datetime',
                  'ferries.name as ferryName'
                )
                ->orderBy('updated_at', 'desc')
                ->get();
    $params['routes'] = $routes;
    $params['statusMap'] = Routes::$statusMap;

    return view('control_panel_cruise_route_list', $params);
  }
}

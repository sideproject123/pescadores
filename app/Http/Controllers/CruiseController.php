<?php

namespace App\Http\Controllers;

use stdClass;
use Validator;
use App\Destinations;
use App\Ferries;
use App\Routes;
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\SeatsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /*
    $seats = Seats::where('route_id', 1);
    $params['seatStatus'] = [
      '1A' => 'reserved',
      '1B' => 'na',
      '1C' => 'sold',
      '4H' => 'na',
      '4I' => 'sold',
      '4J' => 'reserved',
      '6A' => 'forbidden',
      '6B' => 'forbidden',
    ];

    $params['seatClass'] = [
      '1A' => 'B',
      '1D' => 'B',
      '6A' => 'B',
      '6B' => 'B',
    ];

    return view('control_panel_cruise_route_list', $params);
    */
  }

  public function showSeatLayout(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'rId' => 'required|digits_between:1,10',
      'fId' => 'required|digits_between:1,3',
    ]);

    if ($validator->fails()) {
      return response($validator->errors->first(), 422);
    }

    $fields = [
      ['route_id', $request->rId],
    ];

    var_dump(SeatsController::getSeatsByFields($fields));
  }
}

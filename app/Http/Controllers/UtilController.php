<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilController extends Controller
{
  static function resultResponse($model, $id = null)
  {
    $resultType = request()->withResult;

    return $model->id;
    /*
    if ($resultType) {
      switch ($resultType) {
        case 'last':
          $id = $id ? $id : $model->id;
          $res = $model::find($id);
          break;
        case 'data':
        default:
          $res = $model::all();
      }

      return response()->json($res);
    }
    */

    return '';
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilController extends Controller
{
  static function resultResponse($model)
  {
    $resultType = request()->withResult;

    if ($resultType) {
      switch ($resultType) {
        case 'data':
          $res = $model;
          break;
        case 'all':
        default:
          $res = $model->all();
      }

      return response()->json($res);
    }

    return '';
  }
}

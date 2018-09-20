<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
  static public $statusMap = ['pending' => '未開放', 'active' => '已啟用', 'cancelled' => '已取消', 'completed' => '已結束'];
  protected $fillable = ['status', 'fromDestinationId', 'toDestinationId', 'datetime', 'ferryId'];
}

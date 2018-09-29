<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seats extends Model
{
  public $timestamps = false;
  protected $fillable = ['route_id', 'ticket_id', 'class', 'position', 'area', 'status', 'row', 'col'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
  protected $fillable = ['fromDestinationId', 'toDestinationId', 'datetime', 'ferryId'];
}

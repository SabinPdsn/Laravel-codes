<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RouteHit extends Model
{
    protected $fillable = ['route_name','hit_count'];
}

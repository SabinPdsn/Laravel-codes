<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sabin extends Model
{
    protected $table = 'user';

    protected $fillable = ['add','subtract','divide','multiply'];
}
